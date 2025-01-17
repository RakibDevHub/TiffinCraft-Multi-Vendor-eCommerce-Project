<section class="section features" id="what">
    <div class="section-heading">
        <h1 class="title">Discover TiffinCraft</h1>
        <h3 class="sub-title">Where Every Meal is a Masterpiece</h3>
        <p class="text">
            Welcome to <span>TiffinCraft</span>, the ultimate destination for
            homemade food enthusiasts and culinary experts alike. Whether you’re a
            passionate home cook eager to share your creations or someone seeking
            the comfort of authentic home-cooked meals,
            <span>TiffinCraft</span> brings together food lovers from all walks of
            life to celebrate the art of cooking and sharing
        </p>
    </div>
    <div class="features-container">
        <?php
        foreach ($features as $feature) {
            echo '<div class="features-content">';
            echo '<i class="' . htmlspecialchars($feature['icon']) . '"></i>';
            echo '<h2>' . htmlspecialchars($feature['title']) . '</h2>';
            echo '<p>' . htmlspecialchars($feature['description']) . '</i>';
            echo '</div>';
        }
        ?>
    </div>
</section>