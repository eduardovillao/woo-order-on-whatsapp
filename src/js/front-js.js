document.addEventListener("DOMContentLoaded", () => {
	const form = document.querySelector(".variations_form");
	if (!form) return;

	const variationInput = form.querySelector("input.variation_id");
	const buttons = document.querySelectorAll(".evowap_btn");
	const messageInput = document.getElementById("woapp_message");
	const nameInput = document.getElementById("woapp_name");
	const linkInput = document.getElementById("woapp_link");
	const phoneInput = document.getElementById("woapp_number");
	const regPriceInput = document.getElementById("woapp_reg_price");

	if (!variationInput || buttons.length === 0) return;

	let lastVariationId = variationInput.value;

	const updateButton = () => {
		const currentVariationId = variationInput.value;
		console.log("Current Variation ID:", currentVariationId);

		if (currentVariationId === "") return;

		const varPhone = phoneInput ? phoneInput.value : "";
		const varMessage = messageInput ? messageInput.value : "";
		const varName = nameInput ? nameInput.value : "";
		const varLink = linkInput ? linkInput.value : "";

		const varPriceEl = form.querySelector(".woocommerce-variation-price");
		const amountEl =
			form.querySelector(".single_variation .amount") ||
			form.querySelector(".amount");

		let priceText = "";
		const varPriceText = varPriceEl ? varPriceEl.textContent.trim() : "";

		if (varPriceText === "" && regPriceInput) {
			priceText = regPriceInput.value;
		} else if (amountEl) {
			priceText = amountEl.textContent.trim();
		}

		const encodedName = encodeURIComponent(varName);
		const encodedPrice = encodeURIComponent(priceText);
		const encodedLink = encodeURIComponent(varLink);

		const fullText = `${varMessage}%0D%0A%0D%0A${encodedName}%0D%0A${encodedPrice}%0D%0A${encodedLink}`;
		const href = `https://wa.me/${varPhone}?text=${fullText}`;

		buttons.forEach((btn) => btn.setAttribute("href", href));
	};

	updateButton();

	const observer = new MutationObserver(() => {
		if (variationInput.value !== lastVariationId) {
			lastVariationId = variationInput.value;
			updateButton();
		} else if (variationInput.value !== "") {
			updateButton();
		}
	});

	observer.observe(form, {
		childList: true,
		subtree: true,
		attributes: true,
	});
});
