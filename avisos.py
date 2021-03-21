import mysql.connector
import datetime
import smtplib
from email.message import EmailMessage
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.base import MIMEBase
from email import encoders

EMAIL_ADDRESS = 'becomesorted@gmail.com'
EMAIL_PASSWORD = 'bzoblgrbnmgpnfli'

mydb = mysql.connector.connect(
  host="localhost",
  user="admin",
  password="rootroot",
  database="proyecto"
)

mycursor = mydb.cursor()
mycursor.execute("SELECT u.avisos, u.id_usuario, u.nombre, u.email, t.nombre, t.descripcion, t.fecha, t.avisada FROM usuarios u, tareas t WHERE u.id_usuario = t.id_usuario AND t.avisada = 0 AND t.fecha <= CURDATE()+u.avisos")
myresult = mycursor.fetchall()

for x in myresult:
  id_usuario = x[0]
  nombre = x[1]
  email = x[2]
  nombre_tarea = x[3]
  descripcion = x[4]
  fecha = x[5]

  asunto = "Tu tarea <{}> expira pronto.".format(nombre_tarea)
  cuerpo = "La tarea <{}> expirara el dia {}. \nDescripcion: {}".format(nombre_tarea, fecha, descripcion)

  msg = EmailMessage()
  msg['Subject'] = asunto
  msg['From'] = EMAIL_ADDRESS
  msg['To'] = 'becomesorted@gmail.com'

  msg.set_content(cuerpo)

  with smtplib.SMTP_SSL('smtp.gmail.com', 465) as smtp:
    smtp.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
    smtp.send_message(msg)
