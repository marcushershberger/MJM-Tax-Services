import consts
#import login

urlcomp = 'http://10.178.40.49/branch/MJM-Tax-Services/signup.php'

# Creating url for next part of test
url2 = consts.IP + "signup.php?key=vbLptkpb"

# Opening web browser, for user gratification
browser = consts.webdriver.Chrome()
browser.get(url2)

# Finding elements to insert test variables
fname = browser.find_element_by_name("fname")
lname = browser.find_element_by_name("lname")
user = browser.find_element_by_name("user")
email = browser.find_element_by_name("email")
password = browser.find_element_by_name("pass")
passVerif = browser.find_element_by_name("passVerif")
phoneNum = browser.find_element_by_name("phoneNum")
street = browser.find_element_by_name("street")
city = browser.find_element_by_name("city")
state = browser.find_element_by_name("state")
zip = browser.find_element_by_name("zip")

q1 = browser.find_element_by_id("1")
a1 = browser.find_element_by_name("sec_ans_1")
q2 = browser.find_element_by_id("2")
a2 = browser.find_element_by_name("sec_ans_2")
q3 = browser.find_element_by_id("3")
a3 = browser.find_element_by_name("sec_ans_3")

# Insert variables to test the creation of an account
fname.send_keys(consts.firstnameC)
lname.send_keys(consts.lastnameC)
user.send_keys(consts.usernameC)
email.send_keys(consts.emailC)
password.send_keys(consts.passwordC)
passVerif.send_keys(consts.passwordC)
phoneNum.send_keys(consts.phoneNumC)
street.send_keys(consts.streetC)
city.send_keys(consts.cityC)
state.send_keys(consts.stateC)
zip.send_keys(consts.zipcodeC)
# regKey.send_keys(registrationKey)
q1.send_keys(consts.q1C)
a1.send_keys(consts.a1C)
q2.send_keys(consts.q2C)
a2.send_keys(consts.a2C)
q3.send_keys(consts.q3C)
a3.send_keys(consts.a3C)

consts.time.sleep(2)

submit = browser.find_element_by_id("submit")
submit.click()

newLink = browser.current_url
usernametaken = 'http://10.178.40.49/branch/MJM-Tax-Services/signup.php?errors=UsernameTaken'

if (newLink == usernametaken):
    print("Passed.")
else:
    print("failed")


# Closing browser
browser.close()
