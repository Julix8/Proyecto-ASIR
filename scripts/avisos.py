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
mycursor.execute("SELECT u.id_usuario, u.nombre, u.email, t.nombre, t.descripcion, t.fecha, t.id_tarea, t.hora, t.avisada, u.avisos FROM usuarios u, tareas t WHERE u.id_usuario = t.id_usuario AND t.avisada = 0 AND t.fecha <= CURDATE()+INTERVAL u.avisos DAY")
myresult = mycursor.fetchall()

for x in myresult:
  id_usuario = x[0]
  nombre = x[1]
  email = x[2]
  nombre_tarea = x[3]
  descripcion = x[4]
  fecha = x[5]
  id_tarea = x[6]
  hora = x[7]

  asunto = "Tu tarea <{}> expira pronto.".format(nombre_tarea)
  cuerpo = "<h2>La tarea '<i>{}</i>' expirará el día '<i>{}</i>' a las '<i>{}</i>'.</h2><p><b>Descripción:</b> '{}'</p><br>-----------------------<br><h3>Accede a tu cuenta: <a href='localhost/proyecto/inicio.php'>Sorted.es</a></h3>".format(nombre_tarea, fecha, hora, descripcion)

  msg = MIMEText(cuerpo ,'html')
  msg['Subject'] = asunto
  msg['From'] = EMAIL_ADDRESS
  msg['To'] = email

  with smtplib.SMTP_SSL('smtp.gmail.com', 465) as smtp:
    smtp.login(EMAIL_ADDRESS, EMAIL_PASSWORD)
    smtp.send_message(msg)

  sql = "UPDATE tareas SET avisada = 1 WHERE id_tarea = '%s'" % id_tarea
  mycursor.execute(sql)
  mydb.commit()
