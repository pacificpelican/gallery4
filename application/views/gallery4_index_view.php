<style>
  h1, h1 a, h1 a:visited {
    font-family: Helvetica, "Segoe UI", Ubuntu, Roboto, sans-serif;
    color: black;
    font-size: 18px;
  }
  h2 {
    font-family: Hack, "Fira Code", Menlo, monospace;
    color: darkblue;
    font-size: 14px;
  }
  span a, span a:visited {
    font-family: Hack, "Fira Code", Menlo, monospace;
    color: darkred;
    font-size: 14px;
  }
  footer#account_footer {
    margin-top: 1.25rem;
  }
</style>

<div class="main col-md-9 col-sm-12 column large-11 small-12" id="user_files_list">
  <h2>Photostream</h2>
  <div class="contactSheetContainer">
    <?	
    $posts_latest_first = $posts;
    ?><table class="table hover stack"><tbody>
    <?
      foreach ($posts_latest_first as $key => $value) {
        echo "<section class='oneImage'>";
          echo "<main class='img_holder'>";
            echo "<a class='img_link' href='". SITE_URL . "/image/" . $value['post_title'] . "'><img src='" . DROPBOXS_FILE_PATH_VIA_ROOT . $value['post_title'] . "'></img></a>";
          echo "</main><aside class='img_caption'>";
          echo $value['img_title'];
          echo "</aside>";
        echo "</section>";
      } 
      ?>
    </table>
  </div>
  <footer id="account_footer">
      <span id="acf"><a href="/account">Account</a></span>
  </footer>
</div>
