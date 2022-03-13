<?php
/*
 * Template Name: Page acount
 * Template Post Type: page
 */
?>

<?php get_header(); ?>
<style>
#aldibnb-acount {
    display: flex;
    flex-wrap: wrap;

    padding: 30px;
}
#aldibnb-acount-header {
    display: flex;
    flex-wrap: wrap;

    flex: 100%;
    padding-bottom: 30px;
}

#aldibnb-acount-header-title {
    flex: 100%;
    font-weight: 700;
    font-size: 22px;

    color: #202020;
}
#aldibnb-acount-header-description {
    flex: 100%;
    font-weight: 400;
    font-size: 18px;

    color: #202020;
}
#aldibnb-acount-header-link-to-create-annonce {
    text-decoration: none;
    background: #A47035;
    color: #fff;

    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
    padding: 10px 16px;
    margin-top: 20px;

    font-weight: 500;
    font-size: 14px;
    text-align: center;
}


.aldibnb-acount-post{
    display: flex;
    flex-wrap: wrap;
}

.aldibnb-acount-post-title {
    flex: 100%;

    color: #A47035;
    font-size: 22px;
    font-weight: 700;

    padding-bottom: 12px;
    border-bottom: 1px solid #000;
}

.aldibnb-acount-post-cards {
    display: flex;
    flex-wrap: wrap;
    flex: 100%;
    justify-content: space-between;

    margin: 20px 0;
}

.aldibnb-acount-post-card {
    display: flex;
    flex-wrap: wrap;
    border-radius: 10px;    
    width: 23%;

    background: #FFFFFF;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    margin-bottom: 15px;
}
.aldibnb-acount-post-card-img {
    width: 100%;
    flex: 100%;
}
.aldibnb-acount-post-card-title {
    text-decoration: none;
    text-align: left;
    font-weight: 600;
    color: #000000;
    flex: 100%;

    font-size: 16px;
    padding: 0px 10px;
}
.aldibnb-acount-post-card-price {
    padding: 5px 10px;
    flex: 100%;

    color: #595959;
    font-size: 16px;
    text-align: right;
}


#aldibnb-acount-post_attente {
    text-align: right;
}
#aldibnb-acount-post_attente-cards {
    align-items: flex-end;
    justify-content: right;
}
</style>
<div id="aldibnb-acount">
    <div id="aldibnb-acount-header">
        <h1 id="aldibnb-acount-header-title">Name, bienvenue sur votre compte</h1>
        <span id="aldibnb-acount-header-description">A partir de cette page, vous pouvez ajouter des offres mais également consulter vos offres (posté, en attente).</span>
        <a id="aldibnb-acount-header-link-to-create-annonce" href="add-property">Ajouter une Annonce</a>
    </div>
    <div id="aldibnb-acount-post_poste">
        <h1 class="aldibnb-acount-post-title" id="aldibnb-acount-post_poste-title">Annonces Postées</h1>
        <span>Consultez vos annonces !</span>
        <div class="aldibnb-acount-post-cards" id="aldibnb-acount-post_poste-cards">
        <?php 
            $args = array(
                'post_type'     => 'property',
                'post_status'    => 'publish',
                'post_author'      => 1
            );
            $properties = get_posts( $args );
        ?>
        <?php 
        foreach($properties as $property) {
        ?>
        <?php 
            $prop = array(
                "id" => $property->ID,
                "name" => $property->post_title, 
                "link" => $property->guid,
                "image" => get_the_post_thumbnail_url($property->ID, 'medium'),
                "price" => get_post_meta( $property->ID, '_price', true )
            );
        ?>
            <div class="aldibnb-acount-post-card" id="aldibnb-acount-post_poste-card">
                <img class="aldibnb-acount-post-card-img" id="aldibnb-acount-post_poste-card-img"
                    src="<?= $prop['image']; ?>"
                    alt="<?= $prop['name']; ?> img"
                >
                <a class="aldibnb-acount-post-card-title" id="aldibnb-acount-post_poste-card-title" href= <?= $prop['link']; ?>> <?= $prop['name']; ?></a>
                <span class="aldibnb-acount-post-card-price" id="aldibnb-acount-post_poste-card-price"><?= $prop['price']; ?>€ / Nuit</span>
            </div>
        <?php } ?>
        </div>
    </div>

    <div class="aldibnb-acount-post" id="aldibnb-acount-post_attente">
        <h1 class="aldibnb-acount-post-title">Annonces En Attente</h1>
        <span>Vos annonces sont en cours de vérification, celles-ci seront publiées et déplacées dans "Annonces postés" une fois validées.</span>
        <div class="aldibnb-acount-post-cards" id="aldibnb-acount-post_attente-cards">
        <?php 
            $args = array(
                'post_type'     => 'property',
                'post_status'    => 'draft',
                'post_author'      => 1
            );
            $properties = get_posts( $args );
        ?>
        <?php 
        foreach($properties as $property) {
        ?>
            <?php 
            $prop = array(
                "id" => $property->ID,
                "name" => $property->post_title, 
                "link" => $property->guid,
                "image" => get_the_post_thumbnail_url($property->ID, 'medium'),
                "price" => get_post_meta( $property->ID, '_price', true )
            );
            ?>
            <div class="aldibnb-acount-post-card" id="aldibnb-acount-post_attente-card">
                <img class="aldibnb-acount-post-card-img" id="aldibnb-acount-post_attente-card-img"
                    src="<?= $prop['image']; ?>"
                    alt="<?= $prop['name']; ?> img"
                >
                <a class="aldibnb-acount-post-card-title" id="aldibnb-acount-post_attente-card-title" href="update-property?post=<?= $prop['id']; ?>"> <?= $prop['name']; ?></a>
                <span class="aldibnb-acount-post-card-price" id="aldibnb-acount-post_attente-card-price"><?= $prop['price']; ?>€ / Nuit</span>
            </div>
        <?php } ?>
        </div>
    </div>

</div>
<?php get_footer(); ?>