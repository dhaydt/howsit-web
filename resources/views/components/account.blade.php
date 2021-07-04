<link href="{{ asset('css/b5vtabs.min.css') }}" rel="stylesheet">
<div class="row">
    <div class="col-md-3">
        <ul class="nav nav-tabs left-tabs" role="tablist">
            <h6 class="text-start">Add Money with :</h6>
            <li class="nav-item" role="presentation">
                <div id="lorem-left-tab" class="nav-link tab-clickable active" data-bs-toggle="tab"
                    data-bs-target="#lorem-left" role="tab" aria-controls="lorem-left" aria-selected="true">CC</a>
            </li>
            <li class="nav-item" role="presentation">
                <div id="ipsum-left-tab" class="nav-link tab-clickable" data-bs-toggle="tab"
                    data-bs-target="#ipsum-left" role="tab" aria-controls="ipsum-left" aria-selected="false">Paypal</a>
            </li>
            <li class="nav-item" role="presentation">
                <!-- use the title attribute to show a tooltip with the full long name
                in case the tab is trucated-->
                <div id="llanfairpwllgwyngyll-left-tab" class="nav-link tab-clickable" data-bs-toggle="tab"
                    data-bs-target="#llanfairpwllgwyngyll-left" title="venmo" role="tab"
                    aria-controls="llanfairpwllgwyngyll-left" aria-selected="false">
                    Venmo</a>
            </li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="container">
            <div class="tab-content">
                <article class="tab-pane fade show active" role="tabpanel" aria-labelledby="lorem-left-tab"
                    id="lorem-left">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="left border">
                                            <div class="d-flex container">
                                                <div class="me-auto align-items-center d-flex">
                                                    <h2 class="fw-bold">CC Payment</h2>
                                                </div>
                                                <div class="icons ms-auto align-items-center d-flex"> <img
                                                        src="https://img.icons8.com/color/48/000000/visa.png" /> <img
                                                        src="https://img.icons8.com/color/48/000000/mastercard-logo.png" />
                                                    <img src="https://img.icons8.com/color/48/000000/maestro.png" />
                                                </div>
                                            </div>
                                            <div class="container">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="cardName" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                            class="form-label text-start d-block mb-0">Cardholder's
                                                            name</label>
                                                        <input type="text" class="form-control" id="cardName"
                                                            placeholder="Linda Williams"
                                                            style="background-color: #eee8e885;">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cardNumber" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                            class="form-label text-start d-block mb-0">Card number
                                                        </label>
                                                        <input type="text" class="form-control" id="cardNumber"
                                                            placeholder="0125 6780 4567 9909"
                                                            style="background-color: #eee8e885;">
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="mb-3 me-3">
                                                            <label for="expiry" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                                class="form-label text-start d-block mb-0">Expiry date
                                                            </label>
                                                            <input type="text" class="form-control" id="expiry"
                                                                placeholder="YY/MM"
                                                                style="background-color: #eee8e885;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cvv" style="color: #a0a0a0;
                                                            font-weight: bold"
                                                                class="form-label text-start d-block mb-0">CVV
                                                            </label>
                                                            <input type="text" class="form-control" id="cvv"
                                                                style="background-color: #eee8e885;">
                                                        </div>
                                                    </div>
                                                    <div class="d-block text-start">
                                                        <input type="checkbox" id="save_card" class="align-left">
                                                        <label for="save_card">Save card details to wallet</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Pay</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <article class="tab-pane fade" role="tabpanel" aria-labelledby="ipsum-left-tab" id="ipsum-left">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="left border">
                                            <div class="d-flex container">
                                                <div class="me-auto align-items-center d-flex">
                                                    <h2 class="fw-bold">Paypal Payment</h2>
                                                </div>
                                                <div class="icons ms-auto align-items-center d-flex"> <img
                                                        src="https://img.icons8.com/color/48/000000/visa.png" /> <img
                                                        src="https://img.icons8.com/color/48/000000/mastercard-logo.png" />
                                                    <img src="https://img.icons8.com/color/48/000000/maestro.png" />
                                                </div>
                                            </div>
                                            <div class="container">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="cardName" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                            class="form-label text-start d-block mb-0">Cardholder's
                                                            name</label>
                                                        <input type="text" class="form-control" id="cardName"
                                                            placeholder="Jack Sparow"
                                                            style="background-color: #eee8e885;">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cardNumber" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                            class="form-label text-start d-block mb-0">Card number
                                                        </label>
                                                        <input type="text" class="form-control" id="cardNumber"
                                                            placeholder="0125 6780 4567 9909"
                                                            style="background-color: #eee8e885;">
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="mb-3 me-3">
                                                            <label for="expiry" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                                class="form-label text-start d-block mb-0">Expiry date
                                                            </label>
                                                            <input type="text" class="form-control" id="expiry"
                                                                placeholder="YY/MM"
                                                                style="background-color: #eee8e885;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cvv" style="color: #a0a0a0;
                                                            font-weight: bold"
                                                                class="form-label text-start d-block mb-0">CVV
                                                            </label>
                                                            <input type="text" class="form-control" id="cvv"
                                                                style="background-color: #eee8e885;">
                                                        </div>
                                                    </div>
                                                    <div class="d-block text-start">
                                                        <input type="checkbox" id="save_card" class="align-left">
                                                        <label for="save_card">Save card details to wallet</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Pay</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <article class="tab-pane fade" role="tabpanel" aria-labelledby="llanfairpwllgwyngyll-left-tab"
                    id="llanfairpwllgwyngyll-left">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="left border">
                                            <div class="d-flex container">
                                                <div class="me-auto align-items-center d-flex">
                                                    <h2 class="fw-bold">Venmo Payment</h2>
                                                </div>
                                                <div class="icons ms-auto align-items-center d-flex"> <img
                                                        src="https://img.icons8.com/color/48/000000/visa.png" /> <img
                                                        src="https://img.icons8.com/color/48/000000/mastercard-logo.png" />
                                                    <img src="https://img.icons8.com/color/48/000000/maestro.png" />
                                                </div>
                                            </div>
                                            <div class="container">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="cardName" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                            class="form-label text-start d-block mb-0">Cardholder's
                                                            name</label>
                                                        <input type="text" class="form-control" id="cardName"
                                                            placeholder="John Doe"
                                                            style="background-color: #eee8e885;">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cardNumber" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                            class="form-label text-start d-block mb-0">Card number
                                                        </label>
                                                        <input type="text" class="form-control" id="cardNumber"
                                                            placeholder="0125 6780 4567 9909"
                                                            style="background-color: #eee8e885;">
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="mb-3 me-3">
                                                            <label for="expiry" style="color: #a0a0a0;
                                                        font-weight: bold"
                                                                class="form-label text-start d-block mb-0">Expiry date
                                                            </label>
                                                            <input type="text" class="form-control" id="expiry"
                                                                placeholder="YY/MM"
                                                                style="background-color: #eee8e885;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cvv" style="color: #a0a0a0;
                                                            font-weight: bold"
                                                                class="form-label text-start d-block mb-0">CVV
                                                            </label>
                                                            <input type="text" class="form-control" id="cvv"
                                                                style="background-color: #eee8e885;">
                                                        </div>
                                                    </div>
                                                    <div class="d-block text-start">
                                                        <input type="checkbox" id="save_card" class="align-left">
                                                        <label for="save_card">Save card details to wallet</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Pay</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
            </div>
        </div>
    </div>
</div>