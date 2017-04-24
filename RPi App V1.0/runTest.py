#python3
import logging
import pyodbc
from threading import Thread, current_thread
import sys
import time
import PyQt5
from PyQt5.QtWidgets import *
from PyQt5.QtGui import QPixmap
from PyQt5 import QtCore
 
# This is our window from QtCreator
import mainwindow
 
# create class for our Raspberry Pi GUI
class MainWindow(QMainWindow, mainwindow.Ui_MainWindow):
    #access variables inside of the UI's file
    def __init__(self):
        super(self.__class__, self).__init__()
        #gets defined in the UI file
        self.setupUi(self) 

class Connection:
    def updateLabels(form,cusName,shopName,item,pic):
        form.updateLabelsUI(cusName,shopName,item,pic)

    #displayNone(form):

    def createConnection():
        dsn = 'rpitestsqlserverdatasource'
        user = 'fourBits@4bits'
        password = '4bitsFTW'
        database = 'TGLDB'
        connString = 'DSN={0};UID={1};PWD={2};DATABASE={3};'.format(dsn,user,password,database)
        conn = pyodbc.connect(connString)
        if conn:
            #If anything went wrong during configuration, it will happen here
            return conn
        else:
            logging.debug('Error connecting to the server!')

    def executeQuery(conn,form):
        cursor = conn.cursor()
        prevEmail=""
        while True:
            cursor.execute('select * from [Display]')
            row = cursor.fetchone()
            #cursor.execute('truncate table [Display]')
            if row is not None:
                logging.info(row)
                if prevEmail!=row[5]:
                    prevEmail=row[5]
                    cusId=row[0]
                    cusName=row[8]
                    shopName=row[7]
                    pixmap1 = QPixmap('man.jpg')
                    pixmap2 = QPixmap('bluejean.jpg')
                    if cusName=='Ben':
                        pixmap1 = QPixmap('man.jpg')
                        pixmap1 = pixmap1.scaled(100, 100, QtCore.Qt.KeepAspectRatio)
                    if cusName=='Anne':
                        pixmap1 = QPixmap('women.jpg')
                        pixmap1 = pixmap1.scaled(100, 100, QtCore.Qt.KeepAspectRatio) 
                    item=row[6]
                    if item=='Blue Jeans':
                        pixmap2 = QPixmap('bluejean.jpg')
                        pixmap2 = pixmap2.scaled(100, 100, QtCore.Qt.KeepAspectRatio)
                    if item=='Red Shirt':
                        pixmap2 = QPixmap('redshirt.jpg')
                        pixmap2 = pixmap2.scaled(100, 100, QtCore.Qt.KeepAspectRatio)
                    form.updateLabelsUI(cusName,shopName,item,pixmap1,pixmap2)
                    time.sleep(6) 
                else:
                    logging.debug('Same customer found!')
                    form.displayNone() 
            else:
                logging.debug('No row found!')
                form.displayNone() 
                       
    def deleteRow(conn):
        cursor = conn.cursor()
        cursor.execute('select * from [testTable]')
            
    def closeConnection(conn):
        conn.close()
        quit()

    if __name__ == "__main__":
        logging.basicConfig(filename='billboardLog.log',level=logging.DEBUG,format='%(asctime)s %(message)s', datefmt='%m/%d/%Y %I:%M:%S %p')
        
        # a new app instance
        app = QApplication(sys.argv)
        form = MainWindow()
        form.show()

        conn=createConnection()
        gui_run_thread = Thread(name='thread_gui', target=executeQuery, kwargs={'conn': conn, 'form' : form})
        gui_run_thread.daemon = True
        gui_run_thread.start()
        
        #without this, the script exits immediately.
        sys.exit(app.exec_())
        closeConnection(conn)
