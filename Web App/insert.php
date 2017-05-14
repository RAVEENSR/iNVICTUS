<?php 
include ("headfile.php"); 
?>
    <title>Insert an Item</title>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <h2 class="header center orange-text">Insert an Item</h2>
            <div class="row center">
            </div>
        </div>
    </div>

    <div class="container">
      <script language="javascript" src="js/products.js" type="text/javascript"></script>
        <br>
        <div class="col s12 m12 l12">
          <div class="row"> 
            <form class="col s12" action="insertProduct.php" method="post">
              <div class="row">
                <div class="input-field col s12">
                  <input  id="name" type="text" class="validate" name="name" required> 
                  <label for="name">Product Name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input  id="image" type="text" class="validate" name="image" required> 
                  <label for="image">Image URL</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input  id="tag1" type="text" class="validate" name="tag1" required> 
                  <label for="tag1">Tag Name 1</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input  id="tag2" type="text" class="validate" name="tag2" required> 
                  <label for="tag2">Tag Name 2</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input  id="tag3" type="text" class="validate" name="tag3" required> 
                  <label for="tag3">Tag Name 3</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input  id="tag4" type="text" class="validate" name="tag4" required> 
                  <label for="tag4">Tag Name  4</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input  id="tag5" type="text" class="validate" name="tag5" required> 
                  <label for="tag5">Tag Name 5</label>
                </div>
              </div>
              <div class="row">
                <button class="btn waves-effect waves-light" type="submit" name="action">Insert Product
                  <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light" type="reset" name="reset">Reset
                  <i class="material-icons right">clear_all</i>
                </button>
              </div>
            </form>
          </div>
        </div>
    </div>
    <?php include("footfile.html"); ?>