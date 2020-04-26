import os
from PIL import Image, ImageFont, ImageDraw
from flask import Flask, request

app = Flask(__name__)


@app.route("/")
def index():
    return "Hello World"


@app.route("/generate/")
def generate():
    certificate = make_certificate(**request.args)
    return certificate


def make_certificate(first_name, last_name, type, track=None):
    def draw_text(filename, type, first_name, last_name, track=None):
        font = "PTSans-Bold.ttf"
        color = "#ff0000"
        size = 50
        track_color = "#000000"
        track_size = 20
        y = 350
        x = 0
        text = "{} {}".format(first_name, last_name).upper()
        if type == "2":
            font = "LeagueSpartan-Bold.otf"
            size = 60
            color = "#e05a47"
            y = 175
            x = 88
            text = "{}\n{}".format(first_name, last_name).upper()
        raw_img = Image.open(os.path.join("certificates", filename))
        img = raw_img.copy()
        draw = ImageDraw.Draw(img)

        # draw name
        PIL_font = ImageFont.truetype(os.path.join("fonts", font), size)
        w, h = draw.textsize(text, font=PIL_font)
        W, H = img.size
        x = (W - w) / 2 if x == 0 else x
        draw.text((x, y), text, fill=color, font=PIL_font)

        # draw track
        if track:
            PIL_font = ImageFont.truetype(os.path.join("fonts", font), track_size)
            w, h = draw.textsize(track, font=PIL_font)
            x, y = 183, 450
            draw.text((x, y), track, fill=track_color, font=PIL_font)
        img_url = os.path.join("static", "{}-{}-{}-30daysofcode.png".format(first_name, last_name, type))
        img.save(img_url)
        return request.host_url + img_url

    tracks = {"frontend": "Front-End Web Development", "backend": "Back-End Web Development", "python": "Python Programming", "android": "Mobile Development", "ui": "UI/UX Design", "design": "Engineering Design"}
    track = tracks.get(track, None)
    if type == "3":
        base_64 = draw_text("average performace.jpg", type, first_name, last_name, track)
    if type == "4":
        base_64 = draw_text("good performance.jpg", type, first_name, last_name, track)
    if type == "5":
        base_64 = draw_text("outstanding.jpg", type, first_name, last_name, track)
    if type == "1":
        base_64 = draw_text("participated.jpg", type, first_name, last_name)
    if type == "2":
        base_64 = draw_text("mentor.jpg", type, first_name, last_name)
    return base_64


if __name__ == "__main__":
    app.run(debug=True)
