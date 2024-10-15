<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Rental & Buy/Sell</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<?php
session_start(); 

?>

<!-- Navigation Bar -->
<header>
    <nav>
        <div class="logo">
            <h1>RealEstate Hub</h1>
        </div>
        <ul>
            <li><a href="property.html">Add Property</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href='index.html'>Log out</a></li>
            
        </ul>
    </nav>
</header>



<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h2>Find Your Dream Property</h2>
        <p>Browse through our listings to find properties for rent or sale.</p>
        <a href="#properties-id" class="cta-btn">Explore Listings</a>
    </div>
</section>

<!-- Property Listings Section -->
<section class="properties" id="properties-id">
    <h2>Featured Properties</h2>
    <div class="property-list">
        <div class="property-item">
            <img src="p20.jpeg" alt="Property 1">
            <h3>Luxury Apartment</h3>
            <p>$1200/month | 2 Beds, 2 Baths</p>
        </div>
        <!-- More property items... -->
    </div>
</section>

<!-- Contact Section -->
<section class="contact">
    <h2>Contact Us</h2>
    <p>Have questions or need help? Get in touch with us!</p>
    <a href="#" class="contact-btn">Contact Now</a>
</section>

<footer>
    <p><a href="index4.html">Demo</a></p>
    <p>&copy; 2024 RealEstate Hub. All rights reserved.</p>
</footer>

</body>
</html>
