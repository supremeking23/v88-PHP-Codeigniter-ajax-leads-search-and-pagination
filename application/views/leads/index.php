<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Leads search and pagination</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){

            function load_leads(res){
                let html = ``;
                    for(let i = 0; i < res.leads.length; i++){
                        // console.log(res.leads[i]);
                        html += `<tr>`;
                        html += `   <th scope="row">${res.leads[i].leads_id}</th>`;
                        html += `   <td>${res.leads[i].first_name}</td>`;
                        html += `   <td>${res.leads[i].last_name}</td>`;
                        html += `   <td>${res.leads[i].date_joined}</td>`;
                        html += `   <td>${res.leads[i].email}</td>`;
                        html += `</tr>`;
                    }
                return html;
            }

            function load_pages(res){
                // let html = ``;
                // for(let i = 1; i <= res.count_leads[0].page_count/50; i++){
                //     html += `<li class="page-item ${(i == 1) ? "active" : ""}">`;
                //     html += `   <a class="page-link" href="${i}">${i}</a>`;
                //     html += `</li>`;
                // }
                let pagination = ``;
                    for(let i = 1; i <= res.count_leads[0].page_count/50; i++){
                        pagination += `<li class="page-item ${(i == res.page) ? "active" : ""}">`;
                        pagination += `   <a class="page-link" href="${i}">${i}</a>`;
                        pagination += `</li>`;
                    }
                return pagination;
            }


            $('.lead_datas').html(`<tr><td colspan="5" style="text-align:center"><img src='<?= base_url()?>assets/img/loading.gif'></td></tr>`);
            $.get("leads/index_json",function(res){
                let html = load_leads(res);
                $('table').addClass("table-striped");
                $(".lead_datas").html(html);
            },'json');


            $.get("leads/pagination_count",function(res){
                let pages = load_pages(res);
                $(".pagination").html(pages);
            },'json');

            $(document).on('click','.page-link',function(){
                console.log($(this).attr("href"));
                let data = {
                    page: $(this).attr("href"),
                };

                $('table').removeClass("table-striped");
                $('.lead_datas').html(`<tr><td colspan="5" style="text-align:center"><img src='<?= base_url()?>assets/img/loading.gif'></td></tr>`);
                $.post('leads/pagination',data,function(response){
                    let html = load_leads(response);
                    $('table').addClass("table-striped");
                    $(".lead_datas").html(html);
                    let pages = load_pages(response);
                    $(".pagination").html(pages);
                },"json");
                return false;
            });

            $('#search').on('input',function(event){
               
                let search_form = $(this).parent().parent();
                let serialize_search_form = search_form.serialize();

                $('table').removeClass("table-striped");
                $('.lead_datas').html(`<tr><td colspan="5" style="text-align:center"><img src='<?= base_url()?>assets/img/loading.gif'></td></tr>`);
                $.post(search_form.attr('action'), serialize_search_form, function(res) {
                    let html = load_leads(res);
                    $('table').addClass("table-striped");
                    $(".lead_datas").html(html);
                },'json');
            });

            $("form").submit(function(){
               
                return false;
            });

            

            // $("form").submit(function(){
            //     console.log($(this).serialize());
            //     $.post($(this).attr('action'), $(this).serialize(), function(res) {
            //         let html = ``;
            //         for(let i = 0; i < res.leads.length; i++){
            //             // console.log(res.leads[i]);
            //             html += `<tr>`;
            //             html += `   <th scope="row">${res.leads[i].leads_id}</th>`;
            //             html += `   <td>${res.leads[i].first_name}</td>`;
            //             html += `   <td>${res.leads[i].last_name}</td>`;
            //             html += `   <td>${res.leads[i].date_joined}</td>`;
            //             html += `   <td>${res.leads[i].email}</td>`;
            //             html += `</tr>`;
            //         }
            //         $(".lead_datas").html(html);
            //         console.log(res);
                    
            //     },'json');
                
            //     console.log(`console`);
            //     console.log('sd',$(this).attr('action'));

            //     return false;
            // });


            // $("#from").on('input',function(event){
            //     console.log("from");
            //     let date_form = $(this).parent().parent();
            //     let serialize_date_form = date_form.serialize();
            //     console.log(serialize_date_form);

            //     $('table').removeClass("table-striped");
            //     $('.lead_datas').html(`<tr><td colspan="5" style="text-align:center"><img src='<?= base_url()?>assets/img/loading.gif'></td></tr>`);
            //     $.post(date_form.attr('action'), serialize_date_form, function(res) {
            //         let html = load_leads(res);
            //         $('table').addClass("table-striped");
            //         $(".lead_datas").html(html);
            //     },'json');
                
            // });

            $("#to").on('input',function(event){
                // let name = $("#search").val();
                // let from = $("#from").val();
                // let to = $("#to").val();
                // alert(from);
                console.log("to");
                let date_form = $(this).parent().parent();
                let serialize_date_form = date_form.serialize();
                console.log(serialize_date_form);

                $('table').removeClass("table-striped");
                $('.lead_datas').html(`<tr><td colspan="5" style="text-align:center"><img src='<?= base_url()?>assets/img/loading.gif'></td></tr>`);
                $.post(date_form.attr('action'), serialize_date_form, function(res) {
                    let html = load_leads(res);
                    $('table').addClass("table-striped");
                    $(".lead_datas").html(html);
                },'json');
                
            });

            // $(".search_date").submit(function(){
                
               
            //     $.post(`leads/search_by_date`, $(".search_date").serialize(), function(res) {
            //         // alert("dotp");
            //         // alert(from);
            //         console.log(res);
            //         let html = ``;
            //         for(let i = 0; i < res.leads.length; i++){
            //             // console.log(res.leads[i]);
            //             html += `<tr>`;
            //             html += `   <th scope="row">${res.leads[i].leads_id}</th>`;
            //             html += `   <td>${res.leads[i].first_name}</td>`;
            //             html += `   <td>${res.leads[i].last_name}</td>`;
            //             html += `   <td>${res.leads[i].date_joined}</td>`;
            //             html += `   <td>${res.leads[i].email}</td>`;
            //             html += `</tr>`;
            //         }
            //         $(".lead_datas").html(html);
            //     },'json');
            // });
                
                
           


        });
    </script>
  </head>
  <body>
    <!-- As a heading -->
    <nav class="navbar navbar-dark bg-primary">
        <span class="navbar-brand mb-0 h1">Navbar</span>
    </nav>

    <div class="container mt-5">

<?php $this->load->view("leads/includes/form");?>

        <div class="row mt-5">
            <div class="col-md-12">
                <nav aria-label="navigation">
                    <ul class="pagination justify-content-end">
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
            <table class="table">
                <thead class="bg-primary text-white"> 
                    <tr>
                    <th scope="col">leads_id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Registered datetime</th>
                    <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody class="lead_datas">
                </tbody>
                </table>
            </div>
        </div>
          
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
 
  </body>
</html>