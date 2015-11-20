# gym
a gym membership purchase system for A2 Computing, 2013-14

The next step on the coding ladder, I improved my PHP and MySQL skills, and got to grips with the Bootstrap CSS framework.

I also finally got to implement a working payment system!

####The Project

Customers are asked what duration/type of membership they would like:

![Customers select duration of membership](screenshots/durationselect.png)
![Customers select type of membership](screenshots/typeselect.png)

They then enter their details and receive a summary of the order:

![Customer enters details](screenshots/enterdetails.png)
![Summary is displayed](screenshots/Summary.png)

Now we take them through PayPal (in sandbox mode):

![PayPal store](screenshots/paypal1.png)

our database is updated (and the customer receives an email) by calling ipn2.php through PayPal's Instant Payment Notification system

The customer is redirected from PayPal back to our site, so we can show them a comforting conformation message, and link them to our portal.
![PayPal redirect](screenshots/paypal2.png)
![Confirmation](screenshots/complete.png)

The portal allows customers to view their current membership stats.

![Portal](screenshots/portal.png)
![Portal2](screenshots/portal2.png)
