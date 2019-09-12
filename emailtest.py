import imapclient
import pyzmail
import pprint

#Connecting to IMAP server.
imapObj = imapclient.IMAPClient('imap.gmail.com', ssl=True)

#Loggin in to IMAP server
imapObj.login('email_address@gmail.com', 'password')

#Select the folder that the email should be in.
imapObj.select_folder('INBOX', readonly=True)

#Search through the inbox for a specific email address.
imapObj.search(['FROM alice@example.com'])

#Retrieving the raw message from UID
rawMessages = imapObj.fetch(UIDs, ['BODY[]'])
#printing raw message
pprint.pprint(rawMessages)

#Retrieving the body from raw message
message = pyzmail.PyzMessage.factory(rawMessages[40041]['BODY[]'])

message.text_part != None
message.text_part.get_payload().decode(message.text_part.charset)

#Disconnecting from IMAP server
imapObj.logout()
