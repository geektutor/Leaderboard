from flask import Flask, request, render_template
import smtplib
import datetime as dt
from email.utils import formatdate
import json
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

app = Flask(__name__)


@app.route("/")
def index():
    return "Hello World"


@app.route("/mail/", methods=['GET', 'POST'])
def mailed():
    req = json.loads(request.args['users'])
    print(req)
    for i in req['users']:
        email, username = i, req['users'][i]
        done = xender(email, username, req['track'])
    return "Sent." if done else "Failed."


def xender(email, username, track):
    def today():
        return formatdate(localtime=True).split(' 2020 ')[0].split(', ')[1].split(' ')[0]
    day = int(today()) - 1
    msg = MIMEMultipart('alternative')
    msg['Subject'] = "New Task Uploaded"
    msg['From'] = "owoeyepo@gmail.com"
    msg['To'] = username + ' <' + email + '>'
    msg['Cc'] = ''
    msg['Bcc'] = ''
    msg['Date'] = formatdate(localtime=True)
    rcpt = [msg['Cc']] + [msg['Bcc']] + [msg['To']]
    text = "Good Morning, " + username + "!"
    html = render_template(
        "body.html", username=username, track=track, day=day)
    part1 = MIMEText(text, 'plain')
    part2 = MIMEText(html, 'html')
    msg.attach(part1)
    msg.attach(part2)
    s = smtplib.SMTP('smtp.gmail.com:587')
    s.starttls()
    s.login(msg['From'], """tqgtemgyovpqbaup""")
    s.sendmail(msg['From'], rcpt, msg.as_string())
    s.quit()

    dt.datetime.now().strftime("%d %B %Y")
    return True


# 30days.autocaps.xyz/mail/?users={"users": {"speedstxrspxxd@gmail.com": "redditor","sodiq.akinjobi@gmail.com": "Geektutor","dosolomon5@gmail.com": "LordGhostX"},"track": "python"}

if __name__ == "__main__":
    app.run(debug=True)

