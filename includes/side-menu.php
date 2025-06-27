<div class="side-menu animate-dropdown outer-bottom-xs backkeyframe" style="border:4px solid #f0eeeb;border-radius:4px;">
  <div class="head" onclick="toggleMenu()">
    <i class="icon fa fa-align-justify fa-fw"></i> Categories
  </div>
  <nav class="yamm megamenu-horizontal" role="navigation">
  <ul class="nav category-nav expanded" id="categoryMenu">
  <?php 
  $sql = mysqli_query($con, "SELECT id, categoryName FROM category");
  while($row = mysqli_fetch_array($sql)) {
  ?>
    <li class="menu-item">
      <a href="category.php?cid=<?php echo $row['id']; ?>" class="dropdown-toggle">
        <i class="icon fa fa-desktop fa-fw"></i>
        <?php echo htmlentities($row['categoryName']); ?>
      </a>
    </li>
  <?php } ?>
</ul>

  </nav>
</div>
<style>
.category-nav {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s ease-in-out;
}

.category-nav.expanded {
  max-height: 500px; /* Set higher if more categories */
}
</style>
<script>
function toggleMenu() {
  const menu = document.getElementById("categoryMenu");
  menu.classList.toggle("expanded");
}
</script>
