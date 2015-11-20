# gym
a gym membership purchase system

Finally got to implement a working payment system!

####The Project
I created a membership booking and payment system for my local gym in PHP, using a MySQL Database.

Customers are asked what type/duration o0f membership they would like:

![Customers select duration of membership](screenshots/durationselect.png)
![Customers select type of membership](screenshots/typeselect.png)

They then enter their details and receive a summary of the order:

![Customer enters details](screenshots/enterdetails.png)
![Summary is displayed](screenshots/Summary.png)

Now we take them through PayPal (in sandbox mode):

![PayPal store](screenshots/paypal1.png)

our database is updated (and the customer receives an email) by calling ipn2.php through PayPal's Instant Payment Notification system

The customer is redirected from PayPal back to our site, so we can show them a comforting conformation message, and link them to our portal, where they can view their current memberships:

![PayPal redirect](screenshots/paypal2.png)
![Portal](screenshots/portal.png)
![Portal2](screenshots/portal2.png)
