<!-- 
        <div class="row d-flex justify-content-between">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="search" name="search" class="form-control" id="search" placeholder="search here...">
                </div>
            </div>
            <div class="col-md-5 d-flex justify-content-between">
                <div class="form-group">
                    <input type="date" name="from" class="form-control" id="from" >
                </div>
                <div class="form-group">
                    <input type="date" name="to" class="form-control" id="to" >
                </div>

                <button type="submit">Submit</button>
            </div>
        </div> -->





        <div class="row d-flex justify-content-between">
            <div class="col-md-3">
                <form action="leads/search_by_name" method="POST" class="search_by_name">
                    <div class="form-group">
                        <input type="search" name="search" class="form-control" id="search" placeholder="search here...">
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <form action="leads/search_by_date" method="POST" class="search_date d-flex justify-content-between align-items-start">
                    <div class="form-group">
                        <input type="date" name="from" class="form-control" id="from" >
                    </div>
                    <div class="form-group">
                        <input type="date" name="to" class="form-control" id="to" >
                    </div>
                   
                </form>
            </div>
        </div>



    <script>

    </script>