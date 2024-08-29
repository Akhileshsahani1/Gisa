<div class="row">
    <div class="col-sm-12">
        <form action="{{ route('customer.transactions') }}">
            <div class="row">
               
                <div class="col-sm-4 mt-3 mb-3">
                    <label for="service">Services</label>
                    <select name="service" id="service" class="form-select form-control">
                    <option value="">All</option>
                    
                    </select>
                </div>
                <div class="col-sm-4 mt-3 mb-3">
                    <label for="date">Created At</label>
                    <input type="date" class="form-control form-control" id="date" name="created_at" value="">
                </div>          
                <div class="col-sm-4 mt-3 mb-3 text-end">
                    <button type="submit" class="btn btn-info me-1"
                        style="margin-top:22px;">Filter</button>
                    <a href="{{ route('customer.transactions') }}" class="btn btn-outline-info ms-1"
                        style="margin-top:22px;">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>
