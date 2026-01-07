@extends('layout.app')



@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- ================= HEADER ================= -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3 class="fw-bold">INVOICE</h3>
                    <p class="mb-1"><strong>Invoice #:</strong> INV-{{ date('Ymd') }}</p>
                    <p class="mb-0"><strong>Date:</strong> {{ date('d M Y') }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h5 class="mb-1">Dream Pos</h5>
                    <p class="mb-0">Dhaka, Bangladesh</p>
                    <p class="mb-0">info@company.com</p>
                    <p>+880 1234 567890</p>
                </div>
            </div>

            <!-- ================= CUSTOMER ================= -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6>Billed To</h6>
                    <select class="form-select mb-2" id="customer_id">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->customer_name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mb-0 customer_address text-muted">Customer Address</p>
                    <p class="mb-0">Email: <span class="customer_email"> </span></p>
                </div>
                <div class="col-md-6 text-end">
                    <h6>Payment Method</h6>
                    <p>Cash / Bank / Mobile Banking</p>
                </div>
            </div>

            <!-- ================= PRODUCT TABLE ================= -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-end">Price</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Discount</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">Action</th>
                        </tr>
                        <tr>
                            <th>
                                <select class="form-select" id="product_id">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                   <option value="{{$product}}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </th>
                            <th class="text-end product_price">0</th>
                            <th>
                                <input type="number" class="form-control product_qty" value="1" min="1">
                            </th>
                            <th>
                                <input type="number" class="form-control product_discount" value="0" min="0">
                            </th>
                            <th>
                                <input type="text" class="form-control product_subtotal" readonly value="0">
                            </th>
                            <th class="text-end">
                                <button class="btn btn-primary" onclick="addItem()">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="cart_items"></tbody>
                </table>
            </div>

            <!-- ================= TOTALS ================= -->
            <div class="row mt-4">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Subtotal</th>
                            <td class="text-end grand_subtotal">0</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td class="text-end grand_discount">0</td>
                        </tr>
                        <tr class="table-light">
                            <th>Grand Total</th>
                            <th class="text-end grand_total">0</th>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- ================= FOOTER ================= -->
            <div class="text-center mt-3">
                <p class="text-muted mb-1">Thank you for your business</p>
                <small>This is a computer-generated invoice</small>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
{{-- <script>
    // document.querySelector('#customer_id').addEventListener("change",function(){

    //     let customer_id=this.value;
    //     let url=`{{ URL('customers/find') }}/${customer_id}`;
         
    //     fetch(`${url}`)
    //     .then(response =>{
    //     // console.log(response)
    //     return response.json()})
    //     .then(data => {
    //         console.log(data);

    //         // document.querySelector('.customer_email').innerText  = data.email;
    //         // document.querySelector('.customer_address').innerText = data.address;
    //     })
    //     .catch((error)=>{console.log(error)})

    // })

    let cart=[];

      document.querySelector("#customer_id").addEventListener("change", function() {
            let customer_id = this.value;

            // alert(customer_id)
            fetch(`{{ URL('people/cust') }}/${customer_id}`,{
                  credentials: 'same-origin'
            })
                .then(res => {
                    console.log(res);
                    return res.json();
                })
                .then(data => {
                    console.log(data);
                    document.querySelector(".customer_email").innerText = data.email
                    document.querySelector(".customer_address").innerText = data.address[0].address
                })
                .catch(error => {
                    console.log(error);
                })

        })

        //product

        document.querySelector("#product_id").addEventListener("change", function(){
            let product=JSON.parse(this.value);
            document.querySelector(".product_qty").value=1;
            document.querySelector(".product_price").innerText=product.discount_price;
            document.querySelector(".product_subtotal").value=product.discount_price;
            
        })

        function addItem(){
            let product=JSON.parse(document.querySelector("#product_id").value);
            let qty=JSON.parse(document.querySelector(".product_qty").value);
            let discount=JSON.parse(document.querySelector(".product_discount").value);
            let subtotal=(qty*product.discount_price)-(qty*discount);

            let p={
                id:product.id,
                name:product.name,
                price:product.discount_price,
                qty,
                discount, 
                subtotal
            }
            let exists=cart.find(item=>item.id== p.id);
            if(exists){
                exists.qty += p.qty;
                exists.subtotal= (exists.qty * exists.price)-(exists.qty* exists.discount);
            }else{
                cart.push(p);
            }

            let total_reduce=cart.reduce((acc,item)=>parseFloat(item.subtotal)+acc,0);

            let total= 0;
            let total_discount=0;
            let total_subtotal=0;

            cart.forEach(item=>{
                total += item.subtotal;
                total_discount += item.discount;
                total_subtotal +=item.price*item.qty;
            });

             document.querySelector(".grand_total").innerText=total
            document.querySelector(".grand_discount").innerText=total_discount
            document.querySelector(".grand_subtotal").innerText=total_subtotal
            
            print()
            
        }
        function print() {
            let html = "";
            cart.forEach(element => {
                html += `

            <tr>
                    <td>${element.name}</td>
                    <td>${element.price}</td>
                    <td>${element.qty}</td>
                    <td>${element.discount}</td>
                    <td>${element.subtotal}</td>
                    <td> <button onclick="handle_delete(${element.id})" class="btn btn-danger">Del</button> </td>

                </tr>

       `;
            });

            document.querySelector("#cart_items").innerHTML = html
            // console.log(html);

        }

        function handle_delete(id) {
            cart = cart.filter(item => item.id != id);
            print()
        }

</script> --}}
<script>
let cart = [];

// ===== Customer Selection =====
document.querySelector("#customer_id").addEventListener("change", function() {
    let customer_id = this.value;

    fetch(`{{ URL('people/cust') }}/${customer_id}`, { credentials: 'same-origin' })
        .then(res => res.json())
        .then(data => {
            document.querySelector(".customer_email").innerText = data.email || '';
            document.querySelector(".customer_address").innerText = data.address?.[0]?.address || '';
        })
        .catch(error => console.log(error));
});

// ===== Product Selection =====
document.querySelector("#product_id").addEventListener("change", function() {
    if (!this.value) return;

    let product = JSON.parse(this.value);
    document.querySelector(".product_qty").value = 1;
    document.querySelector(".product_discount").value = 0;
    document.querySelector(".product_price").innerText = product.discount_price;
    document.querySelector(".product_subtotal").value = product.discount_price;
});

// ===== Add Item =====
function addItem() {
    let product = JSON.parse(document.querySelector("#product_id").value);
    let qty = parseFloat(document.querySelector(".product_qty").value) || 1;
    let discount = parseFloat(document.querySelector(".product_discount").value) || 0;
    let subtotal = (qty * product.discount_price) - (qty * discount);

    let exists = cart.find(item => item.id === product.id);
    if (exists) {
        // Update quantity and subtotal
        exists.qty += qty;
        exists.discount += discount;
        exists.subtotal = (exists.qty * exists.price) ;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.discount_price,
            qty,
            discount,
            subtotal
        });
    }

    renderCart();
}

// ===== Delete Item =====
function handle_delete(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
}

// ===== Update Quantity =====
function handle_qty_change(id, qty) {
    let item = cart.find(item => item.id === id);
    if (!item) return;

    item.qty = parseFloat(qty) || 1;
    item.subtotal = (item.qty * item.price) - (item.qty * item.discount);
    renderCart();
}

// ===== Render Cart & Totals =====
function renderCart() {
    let html = "";
    cart.forEach(item => {
        html += `
        <tr>
            <td>${item.name}</td>
            <td>${item.price}</td>
            <td>
                <input type="number" value="${item.qty}" min="1" onchange="handle_qty_change(${item.id}, this.value)" class="form-control">
            </td>
            <td>${item.discount}</td>
            <td>${item.subtotal}</td>
            <td>
                <button onclick="handle_delete(${item.id})" class="btn btn-danger btn-sm">Del</button>
            </td>
        </tr>
        `;
    });

    document.querySelector("#cart_items").innerHTML = html;

    // Totals
    let total_subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    let total_discount = cart.reduce((sum, item) => sum + (item.discount * item.qty), 0);
    let grand_total = total_subtotal - total_discount;

    document.querySelector(".grand_subtotal").innerText = total_subtotal.toFixed(2);
    document.querySelector(".grand_discount").innerText = total_discount.toFixed(2);
    document.querySelector(".grand_total").innerText = grand_total.toFixed(2);
}

</script>

@endpush


