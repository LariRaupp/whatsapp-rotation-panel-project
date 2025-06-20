# WhatsApp Rotation Panel

A lightweight admin panel that allows rotating WhatsApp contact numbers dynamically via a backend system. Designed for scenarios where customer service or sales teams alternate their responsibilities throughout the week.

## 🔧 Features

- Secure login system with session timeout and logout functionality.
- Admin interface to assign two WhatsApp numbers for each day of the week.
- Numbers are rotated alternately on each click using a persistent counter.
- Fallback WhatsApp number in case of configuration error.
- Protection of sensitive backend files via `.htaccess`.
- Lightweight and responsive frontend.

## 🛠️ Technologies Used

- PHP (backend logic and session control)
- JavaScript (async number fetching and button handling)
- HTML/CSS (static frontend UI)
- JSON (configuration storage)

## 🗂️ Project Structure

- `index.html` – Landing page with WhatsApp CTA button
- `script.js` – Fetches rotating WhatsApp number
- `whatsapp.php` – Backend logic for alternating numbers
- `numbers.php` – Admin panel to assign numbers per day
- `save_numbers.php` – Saves configuration securely
- `login.php` / `logout.php` – Session-based login system
- `config.php` – Auth credentials and session timeout
- `.htaccess` – Access control protection

## ✅ How It Works

1. Admin logs in and configures two WhatsApp numbers per weekday.
2. End-user clicks the button on the landing page.
3. JavaScript requests a number from `whatsapp.php`.
4. The backend rotates between the two assigned numbers for that day.
5. The user is redirected to the correct WhatsApp chat.

## 📦 Use Case

Useful for small businesses or digital service providers where customer support needs to be rotated between agents.

## ⚠️ Disclaimer
This project is a demo version of a real system I developed for a client. All content has been modified for public use and demonstration purposes. Replace it with your actual configuration before deploying.

---

Feel free to fork, improve, or adapt to your needs!
