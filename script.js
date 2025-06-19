async function getWhatsAppNumber() {
  try {
    const response = await fetch('whatsapp.php');
    const data = await response.json();
    return data.number;
  } catch (err) {
    console.error('Error fetching number:', err);
    return '';
  }
}

async function setupWhatsappLink() {
  const number = await getWhatsAppNumber();
  const message = encodeURIComponent("Hi! I'd like to get in touch.");
  const whatsappButton = document.getElementById("whatsapp-btn");

  if (whatsappButton && number) {
    whatsappButton.setAttribute("href", `https://wa.me/${number}?text=${message}`);
  }
}

document.addEventListener("DOMContentLoaded", setupWhatsappLink);
