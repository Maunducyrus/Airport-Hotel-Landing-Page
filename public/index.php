<?php
session_start();
require_once '../config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airport Hotel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Airport Hotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rooms">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#chefs">Chefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="#amenities">Amenities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>

        
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <header id="home" class="hero-section text-white text-center d-flex align-items-center justify-content-center">
        <div class="container">
            <h1>Welcome to Airport Hotel</h1>
            <p>Your comfort is our priority</p>
            <a href="http://localhost/AirportHotel/public/guest_dashboard.php" class="btn btn-warning">Book Room Now</a>
        </div>
    </header>

    <!-- About Us Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Column - Text Content -->
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="about-content p-4 w-100">
                        <h2 class="text-primary fw-bold mb-4">About Airport Hotel</h2>
                        <p class="text-muted">
                            At <strong>Airport Hotel</strong>, we redefine luxury and comfort. Our premium hospitality services ensure 
                            that every guest experiences world-class accommodation, best-dishes, and relaxation.
                        </p>
                        <p class="text-muted">
                            Located near the airport, our hotel offers:- modern amenities, top-notch security, and personalized services
                            to cater to business, leisure travellers, Friends Party and Family Gatherings.
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="#contact" class="btn btn-primary mt-3 px-4 py-2">Get in Touch</a>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Image -->
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div class="w-100">
                        <img src="images/about.jpg" class="img-fluid about-img" alt="Airport Hotel">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-primary fw-bold mb-4">Our Luxurious Rooms</h2>
            <p class="text-center text-muted">Explore our best rooms designed for your comfort and relaxation.</p>
            <div class="row">
                <!-- Deluxe Room -->
                <div class="col-md-4">
                    <div class="card room-card">
                        <img src="images/room 1.jpg" class="card-img-top" alt="Deluxe Room">
                        <div class="card-body">
                            <h5 class="card-title">Deluxe Room</h5>
                            <p class="card-text">Spacious and stylish with a city view, king-size bed and serene atmosphere</p>
                            <a href="http://localhost/AirportHotel/public/guest_dashboard.php">
                            <button class="btn btn-primary" onclick="bookRoom(1)">Book Now</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Suite Room -->
                <div class="col-md-4">
                    <div class="card room-card">
                        <img src="images/room 2.jpg" class="card-img-top" alt="Suite Room">
                        <div class="card-body">
                            <h5 class="card-title">Suite Room</h5>
                            <p class="card-text">A luxurious suite with a private balcony, spacious lounge, and 24/7 room service.</p>
                            <a href="http://localhost/AirportHotel/public/guest_dashboard.php">
                            <button class="btn btn-primary" onclick="bookRoom(2)">Book Now</button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Standard Room -->
                <div class="col-md-4">
                    <div class="card room-card">
                        <img src="images/room 3.jpg" class="card-img-top" alt="Standard Room">
                        <div class="card-body">
                            <h5 class="card-title">Standard Room</h5>
                            <p class="card-text">Comfortable and affordable, perfect for business travellers and solo guests.</p>
                            <a href="http://localhost/AirportHotel/public/guest_dashboard.php">
                            <button class="btn btn-primary" onclick="bookRoom(3)">Book Now</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chefs Section -->
    <section id="chefs" class="py-5">
        <div class="container">
            <h2 class="text-center text-primary fw-bold mb-4">Meet Our Top Chefs</h2>
            <p class="text-center text-muted">Our professional chefs are ready to serve you the best meals.</p>
            
            <div class="row">
                <!-- Chef Card 1 -->
                <div class="col-md-4">
                    <div class="chef-card text-center">
                        <img src="images/chef1.jpg" alt="Chef John" class="chef-img">
                        <div class="chef-info">
                            <h4>Chef John Kingz</h4>
                            <p class="text-muted">Italian pizza Specialist</p>
                            <button class="btn btn-primary" onclick="requestChef(1)">Request Chef</button>
                        </div>
                    </div>
                </div>

                <!-- Chef Card 2 -->
                <div class="col-md-4">
                    <div class="chef-card text-center">
                        <img src="images/chef2.png" alt="Chef Alice" class="chef-img">
                        <div class="chef-info">
                            <h4>Chef John Johnson</h4>
                            <p class="text-muted">Pastry & Desserts Expert</p>
                            <button class="btn btn-primary" onclick="requestChef(2)">Request Chef</button>
                        </div>
                    </div>
                </div>

                <!-- Chef Card 3 -->
                <div class="col-md-4">
                    <div class="chef-card text-center">
                        <img src="images/chef3.jpg" alt="Chef Mark" class="chef-img">
                        <div class="chef-info">
                            <h4>Chef Mark Willis</h4>
                            <p class="text-muted">Chicken Specialist</p>
                            <button class="btn btn-primary" onclick="requestChef(3)">Request Chef</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Chef Card 4 -->
                <div class="col-md-4">
                    <div class="chef-card text-center">
                        <img src="images/chef4.jpg" alt="Chef Lisa" class="chef-img">
                        <div class="chef-info">
                            <h4>Chef Lisa Liz</h4>
                            <p class="text-muted">Seafood & Grilled Dishes</p>
                            <button class="btn btn-primary" onclick="requestChef(4)">Request Chef</button>
                        </div>
                    </div>
                </div>

                <!-- Chef Card 5 -->
                <div class="col-md-4">
                    <div class="chef-card text-center">
                        <img src="images/chef5.jpg" alt="Chef Daniel" class="chef-img">
                        <div class="chef-info">
                            <h4>Chef Daniel Brollins</h4>
                            <p class="text-muted">Vegan & Healthy Meals</p>
                            <button class="btn btn-primary" onclick="requestChef(5)">Request Chef</button>
                        </div>
                    </div>
                </div>

                <!-- Chef Card 6 -->
                <div class="col-md-4">
                    <div class="chef-card text-center">
                        <img src="images/chef6.jpg" alt="Chef Sophie" class="chef-img">
                        <div class="chef-info">
                            <h4>Chef Samantha SM</h4>
                            <p class="text-muted">Continental Dishes Expert</p>
                            <button class="btn btn-primary" onclick="requestChef(6)">Request Chef</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-primary fw-bold mb-4">We Host All Events</h2>
            <p class="text-center text-muted">Celebrate your special moments with us in a luxurious and unforgettable environment.</p>

            <div class="row">
                <!-- Wedding Event -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="images/event1.jpg" alt="Wedding Event" class="event-img">
                        <div class="event-info">
                            <h4>Wedding Ceremony</h4>
                            <p>Make your wedding day unforgettable with our elegant venues and premium services.</p>
                            <button class="btn btn-primary" onclick="requestEvent(1)">Request Event</button>
                        </div>
                    </div>
                </div>

                <!-- Friends Party Event -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="images/event2.jpg" alt="Friends Party" class="event-img">
                        <div class="event-info">
                            <h4>Friends Party</h4>
                            <p>Enjoy an exciting night out with friends with our vibrant atmosphere and great entertainment.</p>
                            <button class="btn btn-primary" onclick="requestEvent(2)">Request Event</button>
                        </div>
                    </div>
                </div>

                <!-- Family Gathering Event -->
                <div class="col-md-4">
                    <div class="event-card">
                        <img src="images/event3.jpg" alt="Family Gathering" class="event-img">
                        <div class="event-info">
                            <h4>Family Gathering</h4>
                            <p>Reconnect with family in a warm and cozy environment while enjoying delicious meals.</p>
                            <button class="btn btn-primary" onclick="requestEvent(3)">Request Event</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities Section -->
    <section id="amenities" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center text-primary fw-bold mb-4">Our Premium Amenities</h2>
            <p class="text-center text-muted">Experience the best-in-class services to make your stay unforgettable.</p>

            <div class="row">
                <!-- Swimming Pool -->
                <div class="col-md-4">
                    <div class="amenity-card">
                        <img src="images/swimming.jpg" alt="Swimming Pool" class="amenity-img">
                        <h4>🏊 Swimming Pool</h4>
                        <p>Take a refreshing dip in our luxurious pool.</p>
                    </div>
                </div>

                <!-- Gym -->
                <div class="col-md-4">
                    <div class="amenity-card">
                        <img src="images/gym.jpg" alt="Gym" class="amenity-img">
                        <h4>💪 Gym & Fitness</h4>
                        <p>Stay fit with our state-of-the-art gym facilities.</p>
                    </div>
                </div>

                <!-- Free Wi-Fi -->
                <div class="col-md-4">
                    <div class="amenity-card">
                        <img src="images/free wifi.jpg" alt="Free Wi-Fi" class="amenity-img">
                        <h4>📶 Free Wi-Fi</h4>
                        <p>Enjoy high-speed internet throughout the hotel.</p>
                    </div>
                </div>

                <!-- Breakfast, Lunch & Dinner -->
                <div class="col-md-4">
                    <div class="amenity-card">
                        <img src="images/dinner1.jpg" alt="Dining Services" class="amenity-img">
                        <h4>🍽 Breakfast, Lunch & Dinner</h4>
                        <p>Indulge in delicious meals prepared by our top chefs.</p>
                    </div>
                </div>

                <!-- Spa & Massage -->
                <div class="col-md-4">
                    <div class="amenity-card">
                        <img src="images/spa.jpg" alt="Spa & Massage" class="amenity-img">
                        <h4>💆 Spa & Massage</h4>
                        <p>Relax and unwind with our professional spa treatments.</p>
                    </div>
                </div>

                <!-- Airport Shuttle -->
                <div class="col-md-4">
                    <div class="amenity-card">
                        <img src="images/shuttle van.jpg" alt="Airport Shuttle" class="amenity-img">
                        <h4>🚐 Airport Shuttle</h4>
                        <p>Enjoy hassle-free transport to and from the airport.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <p class="text-center">Fill in the form below to get in touch with us.</p>

            <!-- Contact Form Container -->
            <div class="contact-container">
                <form class="row g-3" id="contactForm">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2025 Airport Hotel. All Rights Reserved.</p>
            <p>Designed by: Maingidennis | Phone: +254 112468681</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        function bookRoom(roomId) {
            // Implement AJAX call to PHP backend to book room
        }

        function requestChef(chefId) {
            // Implement AJAX call to PHP backend to request chef
        }

        function requestEvent(eventId) {
            // Implement AJAX call to PHP backend to request event
        }

        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Implement AJAX call to PHP backend to submit contact form
        });
    </script>
</body>
</html>