<!DOCTYPE html>
<html>
<head>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
</head>
<body>
    <button id="payment-button">Pay with Khalti</button>

    <script>
        // Function to fetch the total amount from cview.php
        async function fetchTotalAmount() {
            try {
                const response = await fetch('cview.php?fetch_amount=true');
                const data = await response.json();

                if (data.success) {
                    return data.total_amount * 100; // Convert to paisa for Khalti
                } else {
                    alert("Failed to fetch total amount");
                    return null;
                }
            } catch (error) {
                console.error("Error fetching total amount:", error);
                alert("Error fetching total amount");
                return null;
            }
        }

        // Khalti configuration
        var config = {
            publicKey: "test_public_key_xxx", 
            productIdentity: "1234567890",
            productName: "Electro Nepal Product",
            productUrl: "http://electronepal.com/product/123",
            eventHandler: {
                onSuccess(payload) {
                    // Send payload.token to the server for verification
                    fetch('verify.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Payment Successful!");
                        } else {
                            alert("Payment Verification Failed!");
                        }
                    })
                    .catch(err => console.error(err));
                },
                onError(error) {
                    console.error("Error:", error);
                },
                onClose() {
                    console.log("Widget is closing");
                }
            }
        };

        var checkout = new KhaltiCheckout(config);

        document.getElementById("payment-button").onclick = async function () {
            const amount = await fetchTotalAmount();
            if (amount) {
                checkout.show({ amount: amount });
            }
        };
    </script>
</body>
</html>
