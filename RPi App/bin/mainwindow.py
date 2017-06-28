# -*- coding: utf-8 -*-

# Form implementation generated from reading ui file 'mainwindow.ui'
#
# Created by: PyQt5 UI code generator 5.4.1
#
# WARNING! All changes made in this file will be lost!

from PyQt5 import QtCore, QtGui, QtWidgets

class Ui_MainWindow(object):
    def setupUi(self, MainWindow):
        MainWindow.setObjectName("MainWindow")
        MainWindow.resize(1024, 768)
        self.centralWidget = QtWidgets.QWidget(MainWindow)
        self.centralWidget.setObjectName("centralWidget")
        self.graphicsView = QtWidgets.QGraphicsView(self.centralWidget)
        self.graphicsView.setGeometry(QtCore.QRect(290, 40, 381, 701))
        self.graphicsView.setObjectName("graphicsView")
        self.textEdit = QtWidgets.QTextEdit(self.centralWidget)
        self.textEdit.setGeometry(QtCore.QRect(300, 70, 361, 41))
        self.textEdit.setAutoFillBackground(True)
        self.textEdit.setStyleSheet("background-color: rgb(0, 0, 0);")
        self.textEdit.setObjectName("textEdit")
        self.frame_2 = QtWidgets.QFrame(self.centralWidget)
        self.frame_2.setGeometry(QtCore.QRect(300, 110, 361, 591))
        self.frame_2.setFrameShape(QtWidgets.QFrame.StyledPanel)
        self.frame_2.setFrameShadow(QtWidgets.QFrame.Raised)
        self.frame_2.setObjectName("frame_2")
        self.label = QtWidgets.QLabel(self.frame_2)
        self.label.setGeometry(QtCore.QRect(0, 0, 361, 171))
        self.label.setAutoFillBackground(False)
        self.label.setStyleSheet("background-color: rgb(103, 182, 255);")
        self.label.setText("")
        self.label.setTextFormat(QtCore.Qt.AutoText)
        self.label.setObjectName("label")
        self.label_2 = QtWidgets.QLabel(self.frame_2)
        self.label_2.setGeometry(QtCore.QRect(0, 170, 361, 61))
        self.label_2.setAutoFillBackground(False)
        self.label_2.setStyleSheet("background-color: rgb(255, 177, 20);")
        self.label_2.setText("")
        self.label_2.setTextFormat(QtCore.Qt.RichText)
        self.label_2.setObjectName("label_2")
        self.label_3 = QtWidgets.QLabel(self.frame_2)
        self.label_3.setGeometry(QtCore.QRect(70, 180, 31, 41))
        font = QtGui.QFont()
        font.setFamily("Eras Demi ITC")
        font.setPointSize(20)
        font.setBold(True)
        font.setWeight(75)
        self.label_3.setFont(font)
        self.label_3.setStyleSheet("color: rgb(255, 255, 255);")
        self.label_3.setObjectName("label_3")
        self.personName = QtWidgets.QLabel(self.frame_2)
        self.personName.setGeometry(QtCore.QRect(110, 180, 231, 41))
        font = QtGui.QFont()
        font.setFamily("Elephant")
        font.setPointSize(20)
        font.setBold(True)
        font.setWeight(75)
        self.personName.setFont(font)
        self.personName.setStyleSheet("color: rgb(255, 255, 255);")
        self.personName.setScaledContents(True)
        self.personName.setObjectName("personName")
        self.personPic = QtWidgets.QLabel(self.frame_2)
        self.personPic.setGeometry(QtCore.QRect(110, 10, 150, 150))
        self.personPic.setBaseSize(QtCore.QSize(0, 0))
        self.personPic.setText("")
        self.personPic.setPixmap(QtGui.QPixmap("women.jpg"))
        self.personPic.setScaledContents(True)
        self.personPic.setAlignment(QtCore.Qt.AlignCenter)
        self.personPic.setObjectName("personPic")
        self.label_4 = QtWidgets.QLabel(self.frame_2)
        self.label_4.setGeometry(QtCore.QRect(0, 530, 361, 61))
        self.label_4.setAutoFillBackground(False)
        self.label_4.setStyleSheet("background-color: rgb(255, 177, 20);")
        self.label_4.setText("")
        self.label_4.setTextFormat(QtCore.Qt.RichText)
        self.label_4.setObjectName("label_4")
        self.label_5 = QtWidgets.QLabel(self.frame_2)
        self.label_5.setGeometry(QtCore.QRect(10, 540, 341, 41))
        font = QtGui.QFont()
        font.setFamily("Eras Demi ITC")
        font.setPointSize(14)
        font.setBold(True)
        font.setWeight(75)
        self.label_5.setFont(font)
        self.label_5.setStyleSheet("color: rgb(255, 255, 255);")
        self.label_5.setObjectName("label_5")

        self.itemName = QtWidgets.QLabel(self.frame_2)
        self.itemName.setGeometry(QtCore.QRect(0, 230, 361, 41))
        font = QtGui.QFont()
        font.setPointSize(18)
        font.setBold(True)
        font.setWeight(75)
        self.itemName.setFont(font)
        self.itemName.setObjectName("itemName")
        self.itemName.setAlignment(QtCore.Qt.AlignCenter)
        
        self.itemPic = QtWidgets.QLabel(self.frame_2)
        self.itemPic.setGeometry(QtCore.QRect(100, 280, 150, 150))
        self.itemPic.setText("")
        self.itemPic.setPixmap(QtGui.QPixmap("frock.png"))
        self.itemPic.setScaledContents(True)
        self.itemPic.setAlignment(QtCore.Qt.AlignCenter)
        self.itemPic.setObjectName("itemPic")
        self.label_6 = QtWidgets.QLabel(self.frame_2)
        self.label_6.setGeometry(QtCore.QRect(100, 450, 171, 41))
        font = QtGui.QFont()
        font.setPointSize(18)
        font.setBold(True)
        font.setWeight(75)
        self.label_6.setFont(font)
        self.label_6.setObjectName("label_6")

        self.itemName_2 = QtWidgets.QLabel(self.frame_2)
        self.itemName_2.setGeometry(QtCore.QRect(0, 490, 361, 41))
        font = QtGui.QFont()
        font.setPointSize(18)
        font.setBold(True)
        font.setWeight(75)
        self.itemName_2.setFont(font)
        self.itemName_2.setObjectName("itemName_2")
        self.itemName_2.setAlignment(QtCore.Qt.AlignCenter)
        
        MainWindow.setCentralWidget(self.centralWidget)
        self.menuBar = QtWidgets.QMenuBar(MainWindow)
        self.menuBar.setGeometry(QtCore.QRect(0, 0, 1024, 21))
        self.menuBar.setObjectName("menuBar")
        self.menuIntelligent_Advertising_System = QtWidgets.QMenu(self.menuBar)
        self.menuIntelligent_Advertising_System.setObjectName("menuIntelligent_Advertising_System")
        MainWindow.setMenuBar(self.menuBar)
        self.mainToolBar = QtWidgets.QToolBar(MainWindow)
        self.mainToolBar.setObjectName("mainToolBar")
        MainWindow.addToolBar(QtCore.Qt.TopToolBarArea, self.mainToolBar)
        self.statusBar = QtWidgets.QStatusBar(MainWindow)
        self.statusBar.setObjectName("statusBar")
        MainWindow.setStatusBar(self.statusBar)
        self.menuBar.addAction(self.menuIntelligent_Advertising_System.menuAction())

        self.retranslateUi(MainWindow)
        QtCore.QMetaObject.connectSlotsByName(MainWindow)

    def retranslateUi(self, MainWindow):
        _translate = QtCore.QCoreApplication.translate
        MainWindow.setWindowTitle(_translate("MainWindow", "MainWindow"))
        self.textEdit.setHtml(_translate("MainWindow", "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n"
"<html><head><meta name=\"qrichtext\" content=\"1\" /><style type=\"text/css\">\n"
"p, li { white-space: pre-wrap; }\n"
"</style></head><body style=\" font-family:\'MS Shell Dlg 2\'; font-size:8.25pt; font-weight:400; font-style:normal;\">\n"
"<p align=\"center\" style=\" margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; -qt-block-indent:0; text-indent:0px;\"><span style=\" font-size:14pt; font-weight:600; color:#ffffff;\">Intelligent Advertising System</span></p></body></html>"))
        self.label_3.setText(_translate("MainWindow", "Hi"))
        self.personName.setText(_translate("MainWindow", "TextLabel"))
        self.label_5.setText(_translate("MainWindow", "UNLOCK YOUR SMARTPHONE->"))
        self.itemName.setText(_translate("MainWindow", "itemName"))
        self.label_6.setText(_translate("MainWindow", "is available in"))
        self.itemName_2.setText(_translate("MainWindow", "shopName"))
        self.menuIntelligent_Advertising_System.setTitle(_translate("MainWindow", "Intelligent Advertising System"))

    """Updates the labels when a new customer has arrived near to the display
    self: this object
    cusName: Name of the new customer
    shopName: Name of the Shop
    item:the matching item
    pixmap1: the profile picture of the customer
    pixmap2: the picture of the item(which matches with the shop item and the  customer wishlist item)
    """
    def updateLabelsUI(self,cusName,shopName,item,pixmap1,pixmap2):
        
        self.label_3.setText("Hi")
        
        self.personName.setText(cusName)
        self.label_6.setText("is available in")
        self.itemName_2.setText(shopName)
        self.itemName.setText(item)
        self.personPic.setPixmap(pixmap1)
        self.itemPic.setPixmap(pixmap2)
        self.label_5.setText("UNLOCK YOUR SMARTPHONE->") 

    """
    Display nothing if no new customer is near by the display
    self:this object
    """
    def displayNone(self):
        
        self.label_3.setText(" ")
        self.personName.setText(" ")
        self.label_6.setText(" ")
        self.itemName_2.setText(" ")
        self.itemName.setText(" ")
        self.personPic.setText(" ")
        self.itemPic.setText(" ")
        self.label_5.setText(" ")
        




