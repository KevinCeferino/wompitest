const root = document.getElementById("root");
const response = document.getElementById("response");
if (root) {
    fetch("http://wompitest.test/api/v1/payment")
        .then((resp) => resp.json())
        .then(function (datas) {
            let data = datas.data;
            return data.map(function (data) {
                if (!!data.price) {
                    let precio = data.price / 100;
                    root.innerHTML += `<form action="https://checkout.wompi.co/p/" method="GET">
            <!-- OBLIGATORIOS -->
            <input type="hidden" name="public-key" value="${data.llave}" />
            <input type="hidden" name="currency" value="${data.currency}" />
            <input type="hidden" name="amount-in-cents" value="${data.price}" />
            <input type="hidden" name="reference" value="${data.reference}" />
            <!-- OPCIONALES -->
            <input type="hidden" name="signature:integrity" value="${data.firma}"/>
            <input type="hidden" name="redirect-url" value="http://wompitest.test/response" />
            <input type="hidden" name="customer-data:email" value="${data.user_email}" />
            <input type="hidden" name="customer-data:full-name" value="${data.user_name}" />
            <input type="hidden" name="customer-data:phone-number" value="${data.user_phone}" />
            <input type="hidden" name="customer-data:legal-id-type" value="${data.user_legal_id_type}" />
            <input type="hidden" name="customer-data:legal-id" value="${data.user_legal_id}" />
        
            <button type="submit" class="button">Pagar con Wompi ${precio}</button>
            </form>`;
                }
            });
        });
}



if (response) {
    var $_GET = [];
    window.location.href.replace(
        /[?&]+([^=&]+)=([^&]*)/gi,
        function (a, name, value) {
            $_GET[name] = value;
        }
    );
    fetch(`https://sandbox.wompi.co/v1/transactions/${$_GET["id"]}`)
        .then((responses) => responses.json())
        .then((datas) => {
            let data = datas.data;
            const request = new Request(
                "http://wompitest.test/api/v1/transaction",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ id: data.id }),
                }
            );
            fetch(request)
                .then(async (responses) => responses.json())
                .then((datas) => {
                    response.innerHTML = `<ul>
                    <li>Message: ${datas.message}</li>
                    <li>ID: ${datas.id_transaction}</li>
                    <li>STATUS: ${datas.status}</li>
                    ${
                        datas.status_message
                            ? `<li>Mensaje de estado: ${datas.status_message}</li></ul>`
                            : "</ul>"
                    }`;
                });
        });
}
