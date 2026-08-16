<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us - Tech Journey</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>

        .contact-page {

            background-color: #F8FAFC;

            color: #0F172A;

            padding: 100px 20px 65px;
        }


        .contact-page .contact-container {

            max-width: 1050px;

            margin: 0 auto;
        }


        .contact-page .contact-title {

            margin-bottom: 25px;
        }


        .contact-page .contact-title h1 {

            color: #1E3A8A;

            font-size: 36px;

            font-weight: 700;

            margin: 0 0 5px;
        }


        .contact-page .contact-title p {

            color: #64748B;

            font-size: 16px;

            margin: 0;
        }


        .contact-page .contact-content {

            display: grid;

            grid-template-columns: 1fr 1.4fr;

            gap: 35px;

            align-items: stretch;
        }


        .contact-page .contact-info {

            background-color: #FFFFFF;

            border-radius: 12px;

            padding: 30px;

            box-shadow:
                0 5px 20px rgba(15, 23, 42, 0.06);
        }


        .contact-page .info-item {

            display: flex;

            align-items: flex-start;

            gap: 15px;

            margin-bottom: 25px;
        }


        .contact-page .info-icon {

            width: 40px;

            height: 40px;

            min-width: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            background-color: #EEF2FF;

            color: #2563EB;

            border-radius: 8px;

            font-size: 18px;
        }


        .contact-page .info-text strong {

            display: block;

            color: #0F172A;

            font-size: 15px;

            margin-bottom: 4px;
        }


        .contact-page .info-text span {

            color: #64748B;

            font-size: 14px;
        }



        .contact-page .social-title {

            color: #0F172A;

            font-weight: 600;

            margin: 5px 0 15px;
        }


        .contact-page .social-links {

            display: flex;

            gap: 10px;
        }


        .contact-page .social-link {

            width: 38px;

            height: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background-color: #EEF2FF;

            color: #2563EB;

            text-decoration: none;

            font-weight: 600;

            transition: 0.3s;
        }


        .contact-page .social-link:hover {

            background-color: #2563EB;

            color: #FFFFFF;
        }

        .contact-page .contact-form {

            background-color: #FFFFFF;

            border-radius: 12px;

            padding: 30px;

            box-shadow:
                0 5px 20px rgba(15, 23, 42, 0.06);
        }


        .contact-page .form-label {

            color: #0F172A;

            font-size: 14px;

            font-weight: 600;

            margin-bottom: 7px;
        }


        .contact-page .form-control {

            border: 1px solid #E2E8F0;

            border-radius: 7px;

            padding: 10px 12px;

            font-size: 14px;

            height: 43px;
        }


        .contact-page .form-control:focus {

            border-color: #2563EB;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.10);
        }


        .contact-page textarea.form-control {

            height: 125px;

            resize: none;
        }


        .contact-page .send-btn {

            width: 100%;

            height: 45px;

            border: none;

            border-radius: 7px;

            background: linear-gradient(
                90deg,
                #4F46E5,
                #9333EA
            );

            color: #FFFFFF;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.3s;
        }


        .contact-page .send-btn:hover {

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(124, 58, 237, 0.20);
        }


        .success-overlay {

            position: fixed;

            top: 0;
            left: 0;

            width: 100%;
            height: 100%;

            background-color: rgba(15, 23, 42, 0.45);

            display: none;

            align-items: center;

            justify-content: center;

            z-index: 9999;

            padding: 20px;
        }


        .success-box {

            width: 100%;

            max-width: 400px;

            background-color: #FFFFFF;

            border-radius: 18px;

            padding: 35px 30px;

            text-align: center;

            box-shadow:
                0 20px 50px rgba(15, 23, 42, 0.20);

            transform: scale(0.85);

            opacity: 0;

            transition: 0.25s ease;
        }


        .success-overlay.show .success-box {

            transform: scale(1);

            opacity: 1;
        }


        .success-icon {

            width: 65px;

            height: 65px;

            margin: 0 auto 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: linear-gradient(
                135deg,
                #2563EB,
                #7C3AED
            );

            color: #FFFFFF;

            font-size: 30px;

            font-weight: 700;

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.25);
        }


        .success-box h2 {

            color: #1E3A8A;

            font-size: 24px;

            font-weight: 700;

            margin-bottom: 10px;
        }


        .success-box p {

            color: #64748B;

            font-size: 15px;

            line-height: 1.6;

            margin-bottom: 25px;
        }


        .success-btn {

            border: none;

            padding: 10px 35px;

            border-radius: 8px;

            background: linear-gradient(
                90deg,
                #4F46E5,
                #9333EA
            );

            color: #FFFFFF;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.3s;
        }


        .success-btn:hover {

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(124, 58, 237, 0.25);
        }


        @media (max-width: 768px) {

            .contact-page {

                padding: 90px 15px 50px;
            }


            .contact-page .contact-title h1 {

                font-size: 30px;
            }


            .contact-page .contact-content {

                grid-template-columns: 1fr;

                gap: 20px;
            }


            .contact-page .contact-info {

                padding: 25px;
            }


            .contact-page .contact-form {

                padding: 25px;
            }


            .success-box {

                padding: 30px 25px;
            }

        }

    </style>

</head>


<body>


    <?php include 'includes/navbar.php'; ?>



    <main class="contact-page">


        <div class="contact-container">


            <div class="contact-title">

                <h1>
                    Contact Us
                </h1>

                <p>
                    Tell us how we can help you!
                </p>

            </div>


            <div class="contact-content">


                <div class="contact-info">


                    <!-- Email -->

                    <div class="info-item">

                        <div class="info-icon">
                            ✉
                        </div>

                        <div class="info-text">

                            <strong>
                                Email
                            </strong>

                            <span>
                                info@techjourney.com
                            </span>

                        </div>

                    </div>

                    <!-- Phone -->

                    <div class="info-item">

                        <div class="info-icon">
                            ☎
                        </div>

                        <div class="info-text">

                            <strong>
                                Phone
                            </strong>

                            <span>
                                +20 120 400 7800
                            </span>

                        </div>

                    </div>


                    <!-- Location -->

                    <div class="info-item">

                        <div class="info-icon">
                            📍
                        </div>

                        <div class="info-text">

                            <strong>
                                Location
                            </strong>

                            <span>
                               Egypt
                            </span>

                        </div>

                    </div>


                    <!-- Social -->

                    <div class="social-title">
                        Follow Us
                    </div>


                    <div class="social-links">

                        <a href="#" class="social-link">
                            f
                        </a>

                        <a href="#" class="social-link">
                            𝕏
                        </a>

                        <a href="#" class="social-link">
                            in
                        </a>

                        <a href="#" class="social-link">
                            ◎
                        </a>

                    </div>


                </div>


                <div class="contact-form">


                    <form id="contactForm">



                        <div class="row">


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Your Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Your Name"
                                    required
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Your Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Your Email"
                                    required
                                >

                            </div>


                        </div>



                        <div class="mb-3">

                            <label class="form-label">
                                Subject
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Subject"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Your Message
                            </label>

                            <textarea
                                class="form-control"
                                placeholder="Your Message"
                                required
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="send-btn"
                        >
                            Send Message
                        </button>


                    </form>


                </div>


            </div>


        </div>


    </main>


    <div
        class="success-overlay"
        id="successOverlay"
    >

        <div class="success-box">


            <div class="success-icon">
                ✓
            </div>


            <h2>
                Message Sent Successfully!
            </h2>


            <p>
                Thank you for contacting us.
                We'll get back to you soon.
            </p>


            <button
                class="success-btn"
                id="successBtn"
            >
                Done
            </button>


        </div>

    </div>


    <?php include 'includes/footer.php'; ?>

    <script>

        const contactForm =
            document.getElementById("contactForm");

        const successOverlay =
            document.getElementById("successOverlay");

        const successBtn =
            document.getElementById("successBtn");


        contactForm.addEventListener(
            "submit",
            function(event) {

                event.preventDefault();

                successOverlay.style.display = "flex";

                setTimeout(function() {

                    successOverlay.classList.add("show");

                }, 10);

            }
        );


        successBtn.addEventListener(
            "click",
            function() {

                successOverlay.classList.remove("show");

                setTimeout(function() {

                    successOverlay.style.display = "none";

                    contactForm.reset();

                }, 250);

            }
        );


        successOverlay.addEventListener(
            "click",
            function(event) {

                if (event.target === successOverlay) {

                    successOverlay.classList.remove("show");

                    setTimeout(function() {

                        successOverlay.style.display = "none";

                        contactForm.reset();

                    }, 250);

                }

            }
        );

    </script>


</body>

</html>