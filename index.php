<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carpet Cleaning - Christopoulos & Tsamalis</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", sans-serif;
      background: #f8f8f8;
      color: #333;
    }

    header {
      background: #005f73;
      color: white;
      padding: 30px 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
      font-size: 2.5em;
    }

    .section {
      padding: 40px 20px;
      max-width: 900px;
      margin: auto;
    }

    .intro p {
      font-size: 1.2em;
      line-height: 1.6;
    }

    .features {
      background: #e9f5f5;
      border-radius: 10px;
      padding: 30px;
      margin-top: 30px;
    }

    .features ul {
      list-style: none;
      padding-left: 0;
    }

    .features ul li {
      padding: 10px 0;
      font-size: 1.1em;
    }

    .features ul li i {
      color: green;
      margin-right: 10px;
    }
    .cta {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      margin: 40px 0;
    }

    .cta button {
      background: #0a9396;
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 1.2em;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .cta button:hover {
      background: #00757d;
    }

    footer {
      background: #003845;
      color: white;
      text-align: center;
      padding: 20px;
      font-size: 0.9em;
    }

    @media (max-width: 600px) {
      header h1 {
        font-size: 1.8em;
      }

      .cta button {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<?php include 'layouts/header.php'; ?>

  <section class="section intro">
    <p>
      We take care of the cleanliness and freshness of your carpets with professionalism and reliability!
      Our carpet cleaning service has been delivering excellent results for over 30 years — from deep cleaning to
      odor removal, our experienced staff ensures top-quality service for every carpet.
    </p>
  </section>

  <section class="section features">
    <h3>What We Offer</h3>
    <ul>
      <li><i class="fa fa-check-circle"></i> Professional cleaning with modern, eco-friendly equipment</li>
      <li><i class="fa fa-check-circle"></i> Excellent results for every type of carpet</li>
      <li><i class="fa fa-check-circle"></i> Safe and effective stain & odor removal</li>
      <li><i class="fa fa-check-circle"></i> Fast, free home pick-up and delivery</li>
      <li><i class="fa fa-check-circle"></i> Storage in climate-controlled, insured facilities</li>
    </ul>
  </section>

  <section class="section cta">
    <h3>Schedule Your Appointment Today</h3>
    <p>Call us at: <strong>22310 - 44615</strong> or <strong>22310 - 52570</strong></p>
    <button onclick="openModal()">Book Appointment</button>
  </section>

  <?php include 'layouts/footer.php'; ?>


  <div id="bookingModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0,0,0,0.5); z-index:1000; justify-content:center; align-items:center;">
  <div style="background:white; width:90%; max-width:800px; height:90%; border-radius:8px; overflow:hidden; position:relative;">
    <button onclick="openModal()" style="position:absolute; top:10px; right:10px; color:white; border:none; padding:10px 15px; cursor:pointer; z-index:1001;"></button>
    <iframe id="bookingFrame" src="" style="width:100%; height:100%; border:none;"></iframe>
  </div>
</div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function scrollToBooking() {
      $('html, body').animate({
        scrollTop: $('footer').offset().top
      }, 700);
    }
  </script>
</script>

<script>
  function openModal() {
    document.getElementById("bookingFrame").src = "create.php";
    document.getElementById("bookingModal").style.display = "flex";
  }

  function closeModal() {
    document.getElementById("bookingModal").style.display = "none";
    document.getElementById("bookingFrame").src = "";
  }

  document.addEventListener("DOMContentLoaded", function () {
    window.addEventListener("message", function(event) {
      if (event.data === "closeBookingModal") {
        closeModal();
      }
    });
  });
</script>


</body>
</html>
