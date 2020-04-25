# FLASK MAILER

Call the /mail/ endpoint with a GET request of the format below
* domain_half/mail/?users={"users": {email:username, ...}, "track": trackname}
* e.g xyz.xyz/mail/?users={"users": {"abc@gmail.com": "ABCode", "sodiq.akinjobi@gmail.com": "Geektutor", "wow@gmail.com": "Lolmao"}, "track": "python"}

## Return types
* "Sent." - Mails successfully sent to all members of track
* "Failed." - Refresh and retry
