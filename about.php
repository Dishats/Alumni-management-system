<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styling for animations */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease 0.4s, transform 0.8s ease 0.4s; /* Increased delay for visibility */
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .masthead {
            background: url('path_to_your_background_image.jpg') no-repeat center center;
            background-size: cover;
            color: white;
        }

        .img-square {
            width: 250px; /* Increased size */
            height: 250px; /* Increased size */
            object-fit: cover;
            border-radius: 50%;
            transition: transform 0.3s ease; /* Added transition for hover effect */
        }

        .img-square:hover {
            transform: scale(1.05); /* Scale effect on hover */
        }

        .card {
            transition: transform 0.3s ease; /* Added transition for hover effect */
        }

        .card:hover {
            transform: scale(1.05); /* Scale effect on hover */
        }

        .divider {
            border-color: #ffffff;
        }

        .text-content-justify {
            text-align: justify; /* Justifying text for better readability */
        }
    </style>
</head>
<body>

<!-- Common Header -->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4">
                <h1 class="text-uppercase text-white font-weight-bold">About Us</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>

<section class="page-section">
    <div class="container">
        <div class="row mt-4">
            <!-- Founder Section -->
            <div class="col-md-6 mb-4 text-center">
                <img src="images/founder.png" class="img-square fade-up" alt="Founder Image">
            </div>
            <div class="col-md-6 mb-4 fade-up">
                <h3 class="text-primary">Founder</h3>
                <p class="text-content-justify">Meet our visionary founder, whose dedication has laid the foundation of our community. With a background in education and community development, they strive to empower alumni. The founder believes in the power of connection and support among alumni. They initiated various programs aimed at enhancing alumni engagement and networking. Their leadership inspires many to contribute positively to society and foster a culture of collaboration. By focusing on innovation and outreach, the founder has significantly enriched the alumni experience.</p>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Chairperson Section -->
            <div class="col-md-6 mb-4 fade-up">
                <h3 class="text-success">Chairperson</h3>
                <p class="text-content-justify">Our chairperson is dedicated to leading initiatives that empower alumni and foster connections. They have a strong commitment to advancing educational opportunities and creating a robust alumni network. With their experience in strategic planning and community engagement, they have been instrumental in implementing programs that encourage professional growth. The chairperson believes in the importance of mentorship and actively works to bridge gaps between alumni and current students. Their vision for the future includes enhancing collaboration and creating sustainable pathways for alumni involvement.</p>
            </div>
            <div class="col-md-6 mb-4 text-center">
                <img src="images/president.jpeg" class="img-square fade-up" alt="Chairperson Image">
            </div>
        </div>

        <div class="row mt-4">
            <!-- Mission, Vision, Values Cards with Scroll Animation -->
            <div class="col-md-4 mb-4 fade-up">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-header bg-primary text-white">
                        Our Mission
                    </div>
                    <div class="card-body">
                        <p class="card-text">"To foster a supportive community for alumni, offering resources and opportunities for networking and personal growth."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 fade-up">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-header bg-info text-white">
                        Our Vision
                    </div>
                    <div class="card-body">
                        <p class="card-text">"To create a dynamic platform that connects alumni with each other and the institution, promoting lifelong relationships."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 fade-up">
                <div class="card text-center border-light shadow-sm">
                    <div class="card-header bg-warning text-white">
                        Our Values
                    </div>
                    <div class="card-body">
                        <p class="card-text">"At our core lie the values of Integrity, Community, Innovation, and Excellence. We strive to build strong relationships and pioneer new ideas."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript for Scroll-triggered Animation -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fadeElements = document.querySelectorAll(".fade-up");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        });

        fadeElements.forEach((el) => observer.observe(el));
    });
</script>
</body>
</html>
