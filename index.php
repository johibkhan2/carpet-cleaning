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
      background: #f4f9f9;
      color: #333;
    }

    header {
      background: #005f73;
      color: white;
      padding: 40px 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
      font-size: 2.7em;
    }

    .section {
      padding: 50px 20px;
      max-width: 1100px;
      margin: auto;
    }

    .intro p {
      font-size: 1.3em;
      line-height: 1.8;
      text-align: center;
      max-width: 800px;
      margin: auto;
    }

    .features {
      background: #e6f7f7;
      border-radius: 12px;
      padding: 40px;
      margin-top: 50px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .features h3 {
      text-align: center;
      font-size: 1.8em;
      margin-bottom: 30px;
    }

    .features ul {
      list-style: none;
      padding-left: 0;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px 30px;
    }

    .features ul li {
      font-size: 1.15em;
      display: flex;
      align-items: center;
    }

    .features ul li i {
      color: green;
      margin-right: 10px;
    }

    .cta {
      margin-top: 60px;
      background: #dff3f3;
      border-radius: 12px;
      padding: 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .cta-text {
      flex: 1;
      min-width: 280px;
    }

    .cta-text h3 {
      font-size: 1.8em;
      margin-bottom: 10px;
    }

    .cta-text p {
      font-size: 1.2em;
    }

    .cta button {
      background: #0a9396;
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 1.1em;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 20px;
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
      margin-top: 60px;
    }

    /* Modal styles */
    #bookingModal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    #bookingModal.active {
      display: flex;
    }

    .modal-content {
      background: white;
      width: 90%;
      max-width: 800px;
      height: 90%;
      border-radius: 10px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
    }

    .modal-content iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #ff4d4d;
      border: none;
      color: white;
      font-size: 18px;
      padding: 5px 12px;
      cursor: pointer;
      border-radius: 5px;
      z-index: 1001;
    }

    @media (max-width: 768px) {
      .features ul {
        grid-template-columns: 1fr;
      }

      .cta {
        flex-direction: column;
        text-align: center;
      }

      .cta button {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Christopoulos & Tsamalis Carpet Cleaning</h1>
  </header>

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
      <li><i class="fa fa-check-circle"></i> Modern, eco-friendly equipment</li>
      <li><i class="fa fa-check-circle"></i> Excellent results on all carpet types</li>
      <li><i class="fa fa-check-circle"></i> Safe & effective stain and odor removal</li>
      <li><i class="fa fa-check-circle"></i> Free home pick-up and delivery</li>
      <li><i class="fa fa-check-circle"></i> Climate-controlled storage facilities</li>
    </ul>
  </section>

  <section class="section cta">
    <div class="cta-text">
      <h3>Schedule Your Appointment Today</h3>
      <p>Call us at: <strong>22310 - 44615</strong> or <strong>22310 - 52570</strong></p>
    </div>
    <button onclick="openModal()">Book Appointment</button>
  </section>

  <footer>
    &copy; 2025 Christopoulos & Tsamalis - All rights reserved.
  </footer>

  <!-- Modal -->
  <div id="bookingModal">
    <div class="modal-content">
      <button class="close-btn" onclick="closeModal()">✖</button>
      <iframe id="bookingFrame" src=""></iframe>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function openModal() {
      const modal = document.getElementById("bookingModal");
      const iframe = document.getElementById("bookingFrame");
      iframe.src = "create.php"; // replace with actual form URL
      modal.classList.add("active");
    }

    function closeModal() {
      const modal = document.getElementById("bookingModal");
      const iframe = document.getElementById("bookingFrame");
      iframe.src = "";
      modal.classList.remove("active");
    }

    window.addEventListener("message", function (event) {
      if (event.data === "closeBookingModal") {
        closeModal();
      }
    });
  </script>

</body>
</html>

