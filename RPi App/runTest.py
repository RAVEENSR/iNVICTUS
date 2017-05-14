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
        user = 'umen@phatman'
        password = 'Fat123Man'
        database = 'UDB'
        connString = 'DSN={0};UID={1};PWD={2};DATABASE={3};'.format(dsn,user,password,database)

        #server = 'tcp:phatman.database.windows.net' 
        #database = 'UDB' 
        #username = 'umen' 
        #password = 'Fat123Man' 
        #conn = pyodbc.connect('DRIVER={ODBC Driver 13 for SQL Server};SERVER='+server+';DATABASE='+database+';UID='+username+';PWD='+ password)

        
        conn = pyodbc.connect(connString)
        if conn:
            #If anything went wrong during configuration, it will happen here
            return conn
        else:
            logging.debug('Error connecting to the server!')

    def executeQuery(conn,form):
        cursor = conn.cursor()
        username=""
        while True:
            cursor.execute('select * from [Dis]')
            row = cursor.fetchone()
            #cursor.execute('truncate table [Dis]')
            if row is not None:
                logging.info(row)
                if username!=row[3]:
                    username=row[3]
                    shopName=row[0]
                    pixmap1 = QPixmap('Images/man.jpg')
                    pixmap2 = QPixmap('Images/bluejean.jpg')
                    if username=='Jason':
                        pixmap1 = QPixmap('Images/man.jpg')
                        pixmap1 = pixmap1.scaled(100, 100, QtCore.Qt.KeepAspectRatio)
                    if username=='Sam':
                        pixmap1 = QPixmap('Images/women.jpg')
                        pixmap1 = pixmap1.scaled(100, 100, QtCore.Qt.KeepAspectRatio) 
                    item=row[1]
                    if item=='Levies 501 Jeans':
                        pixmap2 = QPixmap('Images/501 OriginalFIT Jeans.JPG')
                        pixmap2 = pixmap2.scaled(100, 100, QtCore.Qt.KeepAspectRatio)
                    if item=='EFINNY Womens Party Frock':
                        pixmap2 = QPixmap('Images/frock.png')
                        pixmap2 = pixmap2.scaled(100, 100, QtCore.Qt.KeepAspectRatio)
                    form.updateLabelsUI(username,shopName,item,pixmap1,pixmap2)
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
