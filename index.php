<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <title>Flipper</title>
</head>

<?php 
$servers = array(
  (object) [
    'url' => 'http://158.160.1.7:8056/',
    'name' => 'Europe/West APC'
  ],
  (object) [
    'url' => 'http://158.160.1.7:28056/',
    'name' => 'Asia/East APC'
  ],
  (object) [
    'url' => 'https://west.albion-online-data.com/',
    'name' => 'Europe/West AOD'
   ],
   (object) [
     'url' => 'https://east.albion-online-data.com/',
     'name' => 'Asia/East AOD'
   ],
);  
?>

<body>
  <header>
    <ul class="nav nav-tabs flex-column flex-sm-row border-sm-0-reverse d-flex align-items-center">
      <li class="nav-item">
        <a class="nav-link disabled" href="" tabindex="-1" aria-disabled="true" translate="no">Flipper <i
            class="far fa-heart text-danger"></i><span class="disabled float-right d-sm-none">Made with <i
              class="fas fa-brain text-info">
            </i></span></a>
      </li>
      <div class="dropdown-divider d-sm-none d-block"></div>
      <li class="nav-item">
        <a class="nav-link border-sm-0-reverse active" data-toggle="tab" href="#results" role="tab">Results</a>
      </li>
      <li class="nav-item">
        <a class="nav-link border-sm-0-reverse" data-toggle="tab" href="#settings" role="tab">Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link border-sm-0-reverse" data-toggle="tab" href="#tutorial" role="tab">Tutorial</a>
      </li>
      <li class="nav-item">
        <a class="nav-link border-sm-0-reverse" data-toggle="tab" href="#cart_tab" role="tab">Cart</a>
      </li>
      <div class="dropdown show">
        <a id="current-albionflipper-server" class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Current server
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <?php 
          foreach($servers as $key => $server) {
            ?>
              <a class="dropdown-item" onclick="setCurrentServer('<?php echo $server->url ?>', '<?php echo $server->name ?>')"><?php echo $server->name ?></a>
            <?php
          }
        ?>
        </div>
    </div>
      <li class="nav-item ml-auto d-none d-sm-block">
        <a class="nav-link disabled h6" data-toggle="tab" href="" role="tab">
          Made with <i class="fas fa-brain text-info"> </i>
        </a>
      </li>
      <div class="dropdown-divider d-sm-none d-block"></div>
    </ul>
  </header>
  <main>
    <div class="tab-content">
      <!-- Table of results container -->
      <div class="tab-pane pt-2 fade show active" id="results" role="tabpanel">
        <div class="container-fluid">
          <div class="table-responsive">
            <table id="table" class="table table-sm sortable" cellspacing="0">
              <thead>
                <tr>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Tier and enchantment of the item in the format: TIER.ENCHANTMENT">Tier
                  </th>
                  <th data-toggle="tooltip" data-placement="top" title="Name of the item to flip">Name</th>
                  <th data-toggle="tooltip" data-placement="top" title="Profit of the trade with tax included">Profit
                  </th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Profit in percent calculated as (profit/city price)*100">%
                  </th>
                  <th data-toggle="tooltip" data-placement="top" title="The price of the buy order in the Black Market">
                    BM Price</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The quality of the buy order in the Black Market">
                    BM Quality</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the buy order in the Black Market was updated by the Albion Data Client. Will always be less or equal to Max BM Age. If the age is large it can mean that the order has already been filled">
                    BM Age</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The difference between buy and sell order in the Black Market. If it is small there is a risk that the buy order will be filled by the sell order before you can flip the item, especially if flipping between BM and other cities">
                    BM Order Diff.</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the sell order in the Black Market was updated by the Albion Data Client">
                    BM Order Diff. Age</th>
                  <th data-toggle="tooltip" data-placement="top" title="Price of the item in the city">City Sell Price
                  </th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Quality of the item in the city. Can be higher than the BM Quality since you can sell higher quality items to lower quality buy orders">
                    City Quality</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the sell order in the city was updated by the Albion Data Client. Will always be less or equal to Max City Age. If the age is large it can mean that the order has already been filled">
                    City Age</th>
                  <th data-toggle="tooltip" data-placement="top" title="The city where the item can be bought">City</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="If the Black Market buy order can be filled by an item in the Caerleon market. If you are flipping between BM and another city this serves as a warning since the same buy order can be filled much quicker by a Caerleon flipper">
                    Caerleon Profit</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Quality of the item in Caerleon. Can be higher than the BM Quality since you can sell higher quality items to lower quality buy orders">
                    Caerleon Quality</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the sell order in Caerleon was updated by the Albion Data Client. Displays items up to one week old as Caerleon prices do not fluctuate much">
                    Caerleon Age</th>
                  <th data-toggle="tooltip" data-placement="top" title="Add the flip to the shopping cart">Cart</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <button onclick="clearTable('table')" type="button" class="btn btn-danger btn-sm float-right mt-2">
            <i class="far fa-trash-alt"></i> Clear
          </button>
        </div>
      </div>


      <!-- Settings container -->
      <div class="tab-pane fade" id="settings" role="tabpanel">
        <div class="container-fluid">
          <div class="row mt-1">
            <!-- Form start -->
            <div class="col-md-5 col-sm-6">
              <h3 class="pt-2">Settings</h3>
              <div class="form-row mb-0">
                <div class="form-group col-sm-3">
                  <label for="tier">Tier</label>
                  <select name="" id="tier" class="custom-select form-control">
                    <option value="-1">All</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8" selected>8</option>
                  </select>
                </div>
                <div class="form-group col-sm-5">
                  <label for="enchantment">Enchantment</label>
                  <select name="" id="enchantment" class="custom-select form-control">
                    <option value="-1" selected>All</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="quality">Quality</label>
                  <select name="" id="quality" class="custom-select form-control" disabled>
                    <option value="0" selected>All</option>
                    <option value="1">Normal</option>
                    <option value="2">Good</option>
                    <option value="3">Outstanding</option>
                    <option value="4">Excellent</option>
                    <option value="5">Masterpiece</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="cities">Cities</label>
                <fieldset id="cities">
                  <div class="form-check form-check-inline">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" value="Fort Sterling" id="FS" checked>
                      <label class="custom-control-label" for="FS" translate="no">
                        Fort Sterling
                      </label>
                    </div>
                  </div>
                  <div class="form-check form-check-inline">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" value="Thetford" id="TF" checked>
                      <label class="custom-control-label" for="TF" translate="no">
                        Thetford
                      </label>
                    </div>
                  </div>
                  <div class="form-check form-check-inline">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" value="Lymhurst" id="LH" checked>
                      <label class="custom-control-label" for="LH" translate="no">
                        Lymhurst
                      </label>
                    </div>
                  </div>
                  <div class="form-check form-check-inline">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" value="Bridgewatch" id="BW" checked>
                      <label class="custom-control-label" for="BW" translate="no">
                        Bridgewatch
                      </label>
                    </div>
                  </div>
                  <div class="form-check form-check-inline">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" value="Martlock" id="ML" checked>
                      <label class="custom-control-label" for="ML" translate="no">
                        Martlock
                      </label>
                    </div>
                  </div>
                  <div class="form-check form-check-inline">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" value="Caerleon" id="CL" checked disabled>
                      <label class="custom-control-label" for="CL" translate="no">
                        Caerleon
                      </label>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="form-group">
                <label for="minProfitRange">Minimum Profit</label>
                <input type="range" class="custom-range" value=1 min="1" max="500000" id="minProfitRange">
                <input type="number" class="text-center text-sm-right form-control col-sm-4 ml-auto" id="minProfit"
                  value=1>
              </div>
              <div class="form-group">
                <label for="maxAgeBMRange">Maximum <span translate="no">Black Market</span> Age</label>
                <input type="range" class="custom-range" value=20 min="0" max="120" id="maxAgeBMRange">
                <input type="number" class="text-center text-sm-right form-control col-sm-2 ml-auto" id="maxAgeBM"
                  value=20>
              </div>
              <div class="form-group">
                <label for="maxAgeCityRange">Maximum City Age</label>
                <input type="range" class="custom-range" value=20 min="0" max="120" id="maxAgeCityRange">
                <input type="number" class="text-center text-sm-right form-control col-sm-2 ml-auto" id="maxAgeCity"
                  value=20>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="premium" checked>
                <label class="custom-control-label" for="premium">
                  Premium Account
                </label>
              </div>
              <div class="form-group pt-3 mb-0">
                <button onclick="getPrices()" class="btn btn-outline-primary w-100" translate="no">Find
                  Flips!</button>
              </div>

            </div>
            <!-- Form End -->

            <div class="col-md-5 col-sm-6">
              <h3 class="pt-2">Logs</h3>
              <textarea id="console" class="w-100 text-monospace" rows="20" cols="50" disabled
                style="height: 534px;box-sizing:border-box;resize: none;overflow-y: scroll;"></textarea>
              <a onclick="clearConsole()" href="#" class="btn btn-outline-danger w-100 mt-1"><i
                  class="fas fa-eraser"></i></a>
            </div>
            <div class="col-md-2 d-none d-md-block">
              <a href="https://discord.gg/2ySkAuX" target="_blank">
                <div class="w-100 h-100 bg-info d-flex">
                  <div class="justify-content-center align-self-center">
                    <h1 class="text-white-50 text-center">Your ad here</h1>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <a href="https://discord.gg/2ySkAuX" target="_blank">
                <div class="w-100 h-100 bg-info p-5">
                  <h1 class="text-white-50 text-center">Your ad here</h1>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="container-fluid bg-light text-light py-3">
          <div class="progress">
            <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0"
              aria-valuemin="0" aria-valuemax="100" style="width: 0%; "></div>
          </div>
          <span id="progress-text" class="text-muted">0 %</span>
          <div class="float-right text-muted">
            <a class="ml-1 text-body" href="https://github.com/klutten99/AlbionFlipper" target="_blank"><i
                class="fab fa-github-alt"></i></a>
            <a class="ml-1 text-info" href="https://discord.gg/2ySkAuX" target="_blank"><i class="fab fa-discord"></i></a>
          </div>
        </div>
      </div>


      <!-- Tutorial container -->
      <div class="tab-pane fade" id="tutorial" role="tabpanel">
        <div class="container-fluid col-sm-7">
          <h3 class="pt-2">Tutorial</h3>
          <p>For the best possible results, it is strongly suggested to use the Albion Data Client together with this
            tool. The API has no way of telling when an item has been sold, so it is therefore best to assume that if
            either the <strong>BM Age</strong> or <strong>City Age</strong> are high, the buy order has already been
            filled.</p>
          <p>As the best results are achieved by using the Albion Data Client, this tutorial will explain how to
            use Flipper in conjunction with the Albion Data Client. Start by downloading the data client from: <a
              href="http://www.albion-online-data.com" target="_blank">www.albion-online-data.com</a></p>
          <ol>
            <li>Make sure the Albion Data Client is running in the background:
              <img class="w-100" src="images\1.png" alt="">
            </li>
            <li>Login to Albion Online and update the location of your character by switching locations (e.g. go out of
              the bank and then back into the bank). Example of how the Data Client should respond:

              <img class="w-100" src="images\2.png" alt="" />
            </li>
            <li>Go to whatever market you want to flip from and select the <strong>Category</strong>,
              <strong>Tier</strong>, <strong>Enchantment</strong> and <strong>Quality</strong> of the items you want to
              flip. An efficient way of updating many items is to, for example, choose <strong>Tier 8</strong> and
              category: <strong>Accessories.</strong>
              <img class="w-100" src="images\3.png" alt="" />
            </li>
            <li>Keep pressing the next page arrow (marked with a red box in the image below) until you either hit page
              20 or there are no more pages with items left. In the image below we hit the maximum page 20 meaning that
              there are still more items we can update.
              <img class="w-100" src="images\4.png" alt="" />
            </li>
            <li>Click the <strong>Price</strong> column (marked with a red box in the image below) to sort the items in
              the opposite order (if previously they were sorted in ascending order, now they will be sorted in
              descending order). In our example the items are now in descending order (by price), meaning that they get
              cheaper as we go.
              <img class="w-100" src="images\5.png" alt="" />
            </li>
            <li>Repeat <strong>Step 4</strong>. Here you can stop once you reach the same prices as on the last page 20
              in <strong>Step 4</strong>. In the image below we can see that the prices on page 10 are descending from
              1&nbsp;289&nbsp;999. This means that the range of prices we updated is 79&nbsp;995 &ndash;
              1&nbsp;332&nbsp;999 (price of the first and last item in <strong>Step 3</strong> and <strong>4</strong>
              respectively) and 30&nbsp;000&nbsp;000 &ndash; 1&nbsp;279 998 (price of the first and last item in
              <strong>Step 5</strong> and <strong>6</strong> respectively). In other words, we have updated all the
              <strong>Tier 8 Accessories</strong> in the <strong>Fort Sterling</strong> market. Now repeat <strong>steps
                3 &ndash; 6</strong> for <strong>Armor</strong>, <strong>Magic</strong>, <strong>Melee</strong>,
              <strong>Off-Hand</strong>, <strong>Ranged</strong> and <strong>Tool</strong> categories.

              <img class="w-100" src="images\6.png" alt="" />
              While you are updating the items make sure the Albion Data Client is sending the updates (see the image
              below for how it looks when the items are being updated). If you are getting errors, try updating your
              location (leave and enter the market for example).
              <img class="w-100" src="images\6_2.png" alt="" />
            </li>
            <li>Fast travel to the <strong>Black Market</strong> and update the same items as you did in the previous
              market (repeat <strong>steps 3 &ndash; 6</strong>). <strong>Hint: have one of your characters be in the
                Black Market so you can quickly switch characters and update the Black Market without fast
                travel!</strong>
              <br /><br />
            </li>
            <li>Choose the appropriate parameters in Flipper and click the &ldquo;Find Flips!&rdquo; button. Make sure
              the <strong>Max BM Age</strong> and <strong>Max City Age</strong> are as low as possible. The API has no
              way of knowing when an item has been sold, so if you choose a too large age there is a chance the buy
              order has already been filled. In our example we choose the following parameters:
              <img class="w-100" src="images\8.png" alt="" />
            </li>
            <li>Sort the table by profits by clicking the <strong>Profit (with tax)</strong> column title (marked with
              red box) and execute the top trades. If there are a lot of different entries feel free to add the ones you
              want to execute into the cart by pressing the plus button in the cart column (marked with red box).
              <strong>Hint: you can click on any cell in the table to copy its content. You can then, for example, paste
                the name of the item in the market search to find it and buy it faster!</strong>
              <img class="w-100" src="images\9.png" alt="" />
              <img class="w-100" src="images\9_2.png" alt="" />
            </li>
          </ol>
          <p><strong>Some Last Words and Tips</strong></p>
          <p>This is merely a suggestion on how to get started with Flipper. Updating items in this manner will usually
            not work for lower tiers that have a lot more items for sale than tier 8. In that case you will for example
            have to update each quality or enchantment one by one. If you know which items are usually profitable then
            you can only update these. </p>
          <p>If you wish to only flip items between the Caerleon market and the Black Market, then you can uncheck all
            the other cities. Caerleon is always checked as the program uses the Caerleon item data to warn users
            flipping from other cities if the same buy order can be filled by the Caerleon market. This causes Caerleon
            trades to also appear in the table, so sort first by profit and then by city if you only want to flip from
            another city and ignore Caerleon. </p>
          <p>The reason why quality is set to all and cannot be changed is because the program compares the different
            combinations of trades and qualities that can be made and displays the trades that would give the highest
            net profit if all the trades for the same item were executed. </p>
          <p>The key in market flipping is speed. The item data that you are sending is public and other people using
            Flipper will also see the same trades as you. You need to therefore be fast in updating the items and then
            executing the trades. If you don’t make a trade in time you can usually recover most of the money by putting
            it up for sale on one of the markets or on the Black Market, albeit it will take time to sell.</p>
          <p>On that note, we wish you good luck and happy flipping!</p>
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/cz4VEmaDG7k"></iframe>
          </div>
        </div>
      </div>


      <!-- Cart container -->
      <div class="tab-pane fade pt-2" id="cart_tab" role="tabpanel">
        <div class="container-fluid">

          <div class="table-responsive">
            <table id="cart" class="table table-sm sortable" cellspacing="0">
              <thead>
                <tr>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Tier and enchantment of the item in the format: TIER.ENCHANTMENT">Tier
                  </th>
                  <th data-toggle="tooltip" data-placement="top" title="Name of the item to flip">Name</th>
                  <th data-toggle="tooltip" data-placement="top" title="Profit of the trade with tax included">Profit
                  </th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Profit in percent calculated as (profit/city price)*100">%
                  </th>
                  <th data-toggle="tooltip" data-placement="top" title="The price of the buy order in the Black Market">
                    BM Price</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The quality of the buy order in the Black Market">
                    BM Quality</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the buy order in the Black Market was updated by the Albion Data Client. Will always be less or equal to Max BM Age. If the age is large it can mean that the order has already been filled">
                    BM Age</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The difference between buy and sell order in the Black Market. If it is small there is a risk that the buy order will be filled by the sell order before you can flip the item, especially if flipping between BM and other cities">
                    BM Order Diff.</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the sell order in the Black Market was updated by the Albion Data Client">
                    BM Order Diff. Age</th>
                  <th data-toggle="tooltip" data-placement="top" title="Price of the item in the city">City Sell Price
                  </th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Quality of the item in the city. Can be higher than the BM Quality since you can sell higher quality items to lower quality buy orders">
                    City Quality</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the sell order in the city was updated by the Albion Data Client. Will always be less or equal to Max City Age. If the age is large it can mean that the order has already been filled">
                    City Age</th>
                  <th data-toggle="tooltip" data-placement="top" title="The city where the item can be bought">City</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="If the Black Market buy order can be filled by an item in the Caerleon market. If you are flipping between BM and another city this serves as a warning since the same buy order can be filled much quicker by a Caerleon flipper">
                    Caerleon Profit</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="Quality of the item in Caerleon. Can be higher than the BM Quality since you can sell higher quality items to lower quality buy orders">
                    Caerleon Quality</th>
                  <th data-toggle="tooltip" data-placement="top"
                    title="The time (in minutes) since the sell order in Caerleon was updated by the Albion Data Client. Displays items up to one week old as Caerleon prices do not fluctuate much">
                    Caerleon Age</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>

          <button onclick="clearTable('cart')" type="button" class="btn btn-danger btn-sm float-right">
            <i class="far fa-trash-alt"></i> Clear
          </button>
        </div>
      </div>
    </div>
    </div>
  </main>




<script type="text/javascript">
var currentUTCTime="<?php
$timezone = -1; //GMT -01:00
echo(gmdate("d M Y G:i:s e", time()+3600*($timezone+date("I"))));
?>";
</script>
  <script type="text/javascript" src="js/items.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
  </script>
  <script src="https://kit.fontawesome.com/9298b1d4d7.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="js/bootstrap/bootstrap-sortable.js"></script>
  <script type="text/javascript" src="js/moment.js"></script>
  <script>
    function setCurrentServer(url, name) {
      localStorage.setItem('albionflipperServerURL', JSON.stringify({ url, name }));

      updateCurrentServerName();
    }

    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en'
      }, 'google_translate_element');
    }

    function updateCurrentServerName() {
      const currentServer = localStorage.getItem('albionflipperServerURL');

      if (!currentServer) {
        setCurrentServer('http://158.160.1.7:8056/', 'Europe/West APC');

        return;
      }

      const { name, url } = JSON.parse(currentServer);

      const currentServerElement = $('#current-albionflipper-server');
      currentServerElement.text(name);
    }

    $(document).ready(function () {
      $("[type=number]").change(function () {
        var newv = $(this).val();
        $(this).prev().val(newv);
      });

      updateCurrentServerName();
    });

    $(document).ready(function () {
      $("[type=range]").change(function () {
        var newv = $(this).val();
        $(this).next().val(newv);
      });
    });
  </script>

</body>

</html>
