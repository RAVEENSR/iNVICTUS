#python3
# Developed by Raveen S Rathnayake
# Updated on 2017-05-21
import logging
import pyodbc
from threading import Thread, current_thread
import os, configparser,argparse
import sys
import time
import PyQt5
from PyQt5.QtWidgets import *
from PyQt5.QtGui import QPixmap
from PyQt5 import QtCore, QtGui, QtWidgets
import urllib.request

 
# This is our window from QtCreator
import mainwindow
""" 
# create class for our Raspberry Pi GUI
class MainWindow(QMainWindow, mainwindow.Ui_MainWindow):
    
    #access variables inside of the UI's file
    def __init__(self):
        super(self.__class__, self).__init__()
        #gets defined in the UI file
        self.setupUi(self)
"""

class MainClass():

    def parse_configfile():
        config = configparser.ConfigParser()
        config.read('ias.conf')
        return dict(config.items('main'))

    """
    Updates the labels when a new customer has arrived near to the display
    self: this object
    cusName: Name of the new customer
    shopName: Name of the Shop
    item:the matching item
    pixmap1: the profile picture of the customer
    pixmap2: the picture of the item(which matches with the shop item and the  customer wishlist item)
    """
    def updateLabels(form,cusName,shopName,item,pic):
        form.updateLabelsUI(cusName,shopName,item,pic)

    """
    Creating the connection with the database in /azure
    """
    def createConnection():
        os.chdir('../etc')
        #Adding an argument
        p = argparse.ArgumentParser(description='An u=intelligent advertising system to run on a Raspberry Pi.')
        p.add_argument('-c', '--config_file', help='Path to config file.', default='ias.conf')

        #setting the configuration fu=ile
        config = configparser.ConfigParser()
        config.read('ias.conf')
        config=dict(config.items('main'))

        #reading from the configuration file
        dsn =config['dsn']
        user =config['user']
        password =config['password']
        database =config['database']

        #creating the connection string
        connString = 'DSN={0};UID={1};PWD={2};DATABASE={3};'.format(dsn,user,password,database)

        #creating the connection
        try:
            conn = pyodbc.connect(connString)
            logging.debug('Connection Successfull')
            return conn
        except:
            logging.debug('Error connecting to the server!')
            sys.exit()
    
    """
    Executing the query to retrieve data from the database in azure
    """
    def executeQuery(conn,form):
        form.displayNone()
        #logging.debug('Connection Successfull')
        cursor = conn.cursor()
        username=""
        counter=0
        while True:
            cursor.execute('select * from [Dis]')
            row = cursor.fetchone()
            if row is not None:
                if username!=row[3]:
                    counter=0
                    logging.debug('New customer found!')
                    logging.info(row)
                    username=row[3]
                    shopName=row[0]
                    userImg=row[4]
                    item=row[1]
                    itemImg=row[5]
                    response1 = urllib.request.urlretrieve(userImg,"image01")
                    response2 = urllib.request.urlretrieve(itemImg,"image02")
                    time.sleep(1) 
                    pixmap1 = QPixmap('../etc/image01')
                    pixmap2 = QPixmap('../etc/image02')
                    #pixmap1 = pixmap1.scaled(150, 150, QtCore.Qt.KeepAspectRatio)
                    #pixmap2 = pixmap1.scaled(150, 150, QtCore.Qt.KeepAspectRatio)

                    form.updateLabelsUI(username,shopName,item,pixmap1,pixmap2)
                    time.sleep(6) 
                else:
                    if counter==0:
                        logging.debug('Same customer found!')
                        counter +=1
                        
                    form.displayNone() 
            else:
                logging.debug('No row found!')
                form.displayNone() 
    """
    closing the connection with the database
    """
    def closeConnection(conn):
        conn.close()
        quit()

    """
    the main method
    """
    if __name__ == "__main__":
        
        #defining the format of the log statement
        logging.basicConfig(filename='../etc/billboardLog.log',level=logging.DEBUG,format='%(asctime)s %(message)s', datefmt='%m/%d/%Y %I:%M:%S %p')
        """
        #a new app instance
        app = QApplication(sys.argv)
        form = MainWindow()
        form.show()
        
        """
        import sys
        app = QApplication(sys.argv)
        MainWindow = QtWidgets.QMainWindow()
        ui = mainwindow.Ui_MainWindow()
        ui.setupUi(MainWindow)
        MainWindow.show()
        

        conn=createConnection()

        #creating a thread to run queries continousely
        gui_run_thread = Thread(name='thread_gui', target=executeQuery, kwargs={'conn': conn, 'form' : ui})
        gui_run_thread.daemon = True
        gui_run_thread.start()
        
        #without this, the script exits immediately.
        sys.exit(app.exec_())
        closeConnection(conn)
