import sys
from sklearn.externals import joblib
import socket
import thread
from sklearn.externals import joblib
import re


print "Loading model..."
R=joblib.load('model.pkl')
label_encoder=joblib.load('label_encoder.pkl')

def decode_badge(badge):
    p2=re.compile(r'[a-z0-9A-Z]+')
    if(type(badge) is str):
        new_str=' '.join(p2.findall(badge)).lower()
    else:
        new_str=-10
    return label_encoder.transform([new_str])[0]
	
def handleClient(client):
	argv=client.recv(1024)
	argv=argv.split('#')
	print "argv: ",argv
	argv[5]=decode_badge(argv[5])#assume argv[5] has batch
	price=R.predict([argv])
	print "price: ",price[0]
	client.send(str(price[0]))
	client.close()

def main():
	port=44444
	try:
		s=socket.socket()
		print "Socket successfully created"
	except socket.error as err:
		pass

	try:
		s.bind(('',port))
		print "Socket binded to %s" %(port)
	except socket.error as err:
		pass

	try:
		s.listen(5)
	except socket.error as err:
		pass


	while True:
		c,addr=s.accept()
		print "Got connection from: ",addr
		thread.start_new_thread(handleClient, (c,))
		

if __name__=="__main__":
	main()	