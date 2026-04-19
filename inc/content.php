<?php
/**
 * Static content data for the front page.
 * In production these would move to the Customizer / ACF / CPTs — here they mirror the design prototype.
 *
 * @package JocelyneBosschot
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jb_hero_slides() {
	return array(
		array( 'src' => 'https://cdn.sanity.io/images/ss2h95ey/production/b3fd5894f7a7b1394172e8afa277ea9938da6d95-1928x1920.jpg', 'alt' => 'Arbre de Vie — Jocelyne Bosschot' ),
		array( 'src' => 'https://cdn.sanity.io/images/ss2h95ey/production/1f0e4e7b0bebd7e0c62a05f8644e11b950612b7e-2569x2459.jpg', 'alt' => 'Chèvre — céramique blanche' ),
		array( 'src' => 'https://cdn.sanity.io/images/ss2h95ey/production/989dd1a3799ae3d7e422b0c30d6e4c166a8e32fa-2550x2563.jpg', 'alt' => 'Sculpture dorée' ),
		array( 'src' => 'https://cdn.sanity.io/images/ss2h95ey/production/02f7e3076ef1c08918061570134e7cbddd2e42a5-2607x3596.jpg', 'alt' => 'Noir et Or' ),
		array( 'src' => 'https://cdn.sanity.io/images/ss2h95ey/production/b174475384d8bbd2685daabcafa0532d8ea2fdc6-2560x1920.jpg', 'alt' => 'Totem' ),
	);
}

function jb_galleries() {
	return array(
		'colonnes' => array(
			'label_fr' => 'Colonnes Totem',
			'label_en' => 'Totem Columns',
			'desc_fr'  => "Projet sélectionné par la ville de Limoges, réalisé en résidence dans une grande Manufacture. Appellation « Porcelaine de Limoges ». De dimension monumentale, totalement modulables. Chaque module a fait l'objet d'une composition picturale — émaillage cuisson à 1400°, indélébile et inaltérable.",
			'desc_en'  => 'Project selected by the city of Limoges, created in residence at a major Manufacture. "Porcelaine de Limoges" designation. Monumental and fully modular. Each module features a pictorial composition — glazed at 1400°, indelible and unalterable.',
			'items'    => array(
				array( 'src' => 'https://jbosschot.vercel.app/images/archi_et_colonnes.jpg', 'title' => 'Colonnes Totem — 1', 'sub' => 'Porcelaine blanche de Limoges' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/colonne_fond_rouge.jpeg', 'title' => 'Colonnes Totem — 2', 'sub' => 'Porcelaine émaillée' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/colonne_et_archi_d_interieur.jpg', 'title' => 'Colonnes Totem — 3', 'sub' => 'Porcelaine de Limoges' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/JB_module_COLUMN.jpg', 'title' => 'Colonnes Totem — 4', 'sub' => 'Porcelaine, cuisson 1400°' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/JOCELYNE_BOSSCHOTprojet_d_installation_sur_ciel_gris.jpeg', 'title' => 'Colonnes Totem — 5', 'sub' => 'Porcelaine blanche' ),
			),
		),
		'feu' => array(
			'label_fr' => 'Danse du Feu',
			'label_en' => 'Fire Dance',
			'desc_fr'  => "Cette série explore les grands mythes liés au Feu : invention spécifiquement humaine, symbole de la réalité de la vie elle-même, feu sacré de l'enthousiasme et de la passion intense.",
			'desc_en'  => 'This series explores the great myths of Fire: a uniquely human invention, symbol of life itself, the sacred fire of enthusiasm and intense passion.',
			'items'    => array(
				array( 'src' => 'https://jbosschot.vercel.app/images/DANSE_DU_FEU.jpeg', 'title' => 'Danse du Feu — 1', 'sub' => 'Grès noir, plexiglas' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/DANSE_DU_FEU1.jpeg', 'title' => 'Danse du Feu — 2', 'sub' => 'Grès noir émaillé' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/DANSE_DU_FEUc.jpeg', 'title' => 'Danse du Feu — 3', 'sub' => 'Grès noir, serre-joint alu' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/danse_du_feu1a.jpeg', 'title' => 'Danse du Feu — 4', 'sub' => 'Grès blanc, plexiglas' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/bronze_danse_du_feu2b.jpeg', 'title' => 'Danse du Feu — 5', 'sub' => 'Bronze, socle acier' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/bronze_danse_du_feu2d.jpeg', 'title' => 'Danse du Feu — 6', 'sub' => 'Bronze patiné' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/bronze_danse_du_feu4b.jpeg', 'title' => 'Danse du Feu — 7', 'sub' => 'Bronze, socle métal' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/danse_du_feu_bronze1a.jpeg', 'title' => 'Danse du Feu — 8', 'sub' => 'Bronze, édition limitée' ),
			),
		),
		'arbre' => array(
			'label_fr' => 'Arbre de Vie',
			'label_en' => 'Tree of Life',
			'desc_fr'  => "Thème mythique au symbolisme toujours d'actualité. Frémissements de la matière qui va du sombre mat au satiné somptueux moiré du bronze.",
			'desc_en'  => 'A mythical theme with enduring symbolism. The shimmering of matter, from dark matte to the sumptuous satiny moiré of bronze.',
			'items'    => array(
				array( 'src' => 'https://jbosschot.vercel.app/images/arbre_de_vie_Jocelyne_Bosschot.jpeg', 'title' => 'Arbre de Vie — 1', 'sub' => 'Grès noir chamotté, émail bronze' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/JB_arbre_de_vie_ciel_gris.jpeg', 'title' => 'Arbre de Vie — 2', 'sub' => 'Grès noir, mordoré' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/arbredevie_detail.jpeg', 'title' => 'Arbre de Vie — 3', 'sub' => 'Grès noir très chamotté, 1265°' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/apres_le_deluge.jpeg', 'title' => 'Après le Déluge', 'sub' => 'Grès noir émaillé, bronze' ),
			),
		),
		'fleur' => array(
			'label_fr' => 'Fleur Bleue',
			'label_en' => 'Blue Flower',
			'desc_fr'  => 'Formes végétales en grès émaillé bleu-violet sur tiges de plexiglas.',
			'desc_en'  => 'Vegetal forms in blue-violet glazed stoneware on plexiglas stems.',
			'items'    => array(
				array( 'src' => 'https://jbosschot.vercel.app/images/FLEUBLEU2.jpeg', 'title' => 'Fleur Bleue — 1', 'sub' => 'Grès émaillé bleu-violet, plexiglas' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/FLEUBLUE3.jpeg', 'title' => 'Fleur Bleue — 2', 'sub' => 'Grès émaillé bleu-violet' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/FLEURBLEUa.jpeg', 'title' => 'Fleur Bleue — 3', 'sub' => 'Grès émaillé, tons bleu et violet' ),
			),
		),
		'miroirs' => array(
			'label_fr' => 'Miroirs & Lumières',
			'label_en' => 'Mirrors & Light',
			'desc_fr'  => "L'opposition et le contraste des matières : l'aspect rugueux de la pierre en opposition à la porcelaine recouverte d'or qui brille et illumine. L'or, inaltérable, symbole d'une quête philosophique et spirituelle.",
			'desc_en'  => 'The opposition and contrast of materials: the roughness of stone against gold-covered porcelain that shines and illuminates. Gold, unalterable, symbol of a philosophical and spiritual quest.',
			'items'    => array(
				array( 'src' => 'https://jbosschot.vercel.app/images/JB_miroir_d_Alice_c.jpeg', 'title' => 'Miroirs & Lumières — 1', 'sub' => 'Céramique émaillée or' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/miroir2b.jpeg', 'title' => 'Miroirs & Lumières — 2', 'sub' => 'Céramique dorée' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/M3c.jpeg', 'title' => 'Miroirs & Lumières — 3', 'sub' => 'Grès émaillé or' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/M4b.jpeg', 'title' => 'Miroirs & Lumières — 4', 'sub' => 'Grès émaillé or' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/M7a.jpeg', 'title' => 'Miroirs & Lumières — 5', 'sub' => 'Grès émaillé or' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/M_7b.jpeg', 'title' => 'Miroirs & Lumières — 6', 'sub' => 'Grès émaillé or' ),
			),
		),
		'autres' => array(
			'label_fr' => 'Autres Œuvres',
			'label_en' => 'Other Works',
			'desc_fr'  => 'Sculptures en grès et porcelaine. Chaque pièce unique.',
			'desc_en'  => 'Stoneware and porcelain sculptures. Each piece unique.',
			'items'    => array(
				array( 'src' => 'https://jbosschot.vercel.app/images/ex_natura2N.jpeg', 'title' => 'Ex Natura', 'sub' => 'Grès blanc' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/crane_dor_3.jpeg', 'title' => "Crâne d'Or", 'sub' => 'Céramique émaillée or' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/structure_ondulee.jpg', 'title' => 'Structure Ondulée', 'sub' => 'Grès émaillé' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/lauze1.jpeg', 'title' => 'Lauze', 'sub' => 'Grès et pierre' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/VIERGE_AU_ROCHER1.jpg', 'title' => 'Vierge au Rocher', 'sub' => 'Porcelaine émaillée' ),
				array( 'src' => 'https://jbosschot.vercel.app/images/chevre3_4_dos.jpeg', 'title' => 'Chèvre', 'sub' => 'Grès chamotté' ),
			),
		),
	);
}

function jb_shop_items() {
	return array(
		array( 'src' => 'https://jbosschot.vercel.app/images/arbre_de_vie_Jocelyne_Bosschot.jpeg', 'title' => 'Arbre de Vie', 'material' => 'Grès noir, émail bronze', 'dims' => 'H230 cm — 7 modules', 'price' => 'on_request' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/danse_du_feu_bronze1a.jpeg', 'title' => 'Fleur de Feu', 'material' => 'Grès blanc, plexiglas', 'dims' => '', 'price' => 'on_request' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/bronze_danse_du_feu2b.jpeg', 'title' => 'Danse du Feu — Bronze', 'material' => 'Bronze + socle acier patiné', 'dims' => 'H45 cm', 'price' => 'on_request' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/JB_miroir_d_Alice_c.jpeg', 'title' => 'Lorjadore 3.6', 'material' => "Grès émaillé recouvert d'or", 'dims' => 'H6×L13×P9 cm', 'price' => '280 €' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/M_7b.jpeg', 'title' => 'Lorjadore 3.5', 'material' => "Grès émaillé recouvert d'or", 'dims' => 'H9×L13×P10 cm', 'price' => '460 €' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/M7a.jpeg', 'title' => 'Lorjadore 3.4', 'material' => "Grès émaillé recouvert d'or", 'dims' => 'H11×L18×P9 cm', 'price' => '550 €' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/miroir2b.jpeg', 'title' => 'Lorjadore 3.3', 'material' => "Grès émaillé recouvert d'or", 'dims' => 'H10×L22×P15 cm', 'price' => '995 €' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/M4b.jpeg', 'title' => 'Lorjadore 3.2', 'material' => "Grès émaillé recouvert d'or", 'dims' => 'H22×L17×P12 cm', 'price' => '820 €' ),
		array( 'src' => 'https://jbosschot.vercel.app/images/M3c.jpeg', 'title' => 'Lorjadore 3.1', 'material' => "Grès émaillé recouvert d'or", 'dims' => 'H18×L20×P19 cm', 'price' => '1050 €' ),
	);
}

function jb_timeline() {
	return array(
		array( 'year' => '2017', 'title_fr' => 'Terra Rossa — Salernes', 'title_en' => 'Terra Rossa — Salernes', 'desc_fr' => "Exposition sélection PACA, Ateliers d'Art de France. Maison de la Céramique Architecturale.", 'desc_en' => "PACA selection exhibition, Ateliers d'Art de France. Architectural Ceramics House." ),
		array( 'year' => '2015', 'title_fr' => 'Triennale de Céramique — Pays-Bas', 'title_en' => 'Ceramics Triennial — Netherlands', 'desc_fr' => 'Sélectionnée parmi les artistes français. Association néerlandaise des Céramistes (NVK).', 'desc_en' => 'Selected among French artists. Dutch Ceramists Association (NVK).' ),
		array( 'year' => '2015', 'title_fr' => "Salle l'Eden — Vallauris", 'title_en' => "Salle l'Eden — Vallauris", 'desc_fr' => "Exposition avec l'association d'artistes START, Alpes Maritimes.", 'desc_en' => "Exhibition with START artists' association, Alpes Maritimes." ),
		array( 'year' => '2011', 'title_fr' => 'Biennale Internationale — Corée', 'title_en' => 'International Biennial — Korea', 'desc_fr' => "Gyeonggi CeraMIX Biennale — Diplôme d'Honneur.", 'desc_en' => 'Gyeonggi CeraMIX Biennial — Diploma of Honor.' ),
		array( 'year' => '2010', 'title_fr' => 'Résidence — Manufacture de Limoges', 'title_en' => 'Residency — Limoges Manufacture', 'desc_fr' => 'Réalisation des Colonnes Totem. Sélection ville de Limoges.', 'desc_en' => 'Creation of Totem Columns. Selected by the city of Limoges.' ),
		array( 'year' => '2009', 'title_fr' => 'Concours International de Porcelaine — Limoges', 'title_en' => 'International Porcelain Competition — Limoges', 'desc_fr' => 'Sélectionnée parmi les artistes internationaux.', 'desc_en' => 'Selected among international artists.' ),
	);
}

function jb_exhibitions() {
	return array(
		array( 'year' => '2026', 'name' => "Salon de l'Art Céramique", 'loc_fr' => 'Nice', 'loc_en' => 'Nice', 'status' => 'local', 'badge' => 'Local' ),
		array( 'year' => '2017', 'name' => 'Terra Rossa — Salernes', 'loc_fr' => 'Maison de la Céramique Architecturale, 83690 Salernes', 'loc_en' => 'Architectural Ceramics House, 83690 Salernes', 'status' => 'local', 'badge' => 'PACA' ),
		array( 'year' => '2015', 'name' => "Salle l'Eden — Vallauris", 'loc_fr' => 'Vallauris, Alpes Maritimes', 'loc_en' => 'Vallauris, Alpes Maritimes', 'status' => 'local', 'badge' => 'Local' ),
		array( 'year' => '2015', 'name_fr' => "Maison des Métiers d'Art — Pézenas", 'name_en' => 'House of Crafts — Pézenas', 'loc_fr' => 'Pézenas, Hérault', 'loc_en' => 'Pézenas, Hérault', 'status' => 'local', 'badge' => 'AAF' ),
		array( 'year' => '2015', 'name_fr' => 'Triennale de Céramique — Pays-Bas', 'name_en' => 'Ceramics Triennial — Netherlands', 'loc_fr' => 'Pays-Bas, 28 mars au 28 mai', 'loc_en' => 'Netherlands, March 28 to May 28', 'status' => 'int', 'badge' => 'International' ),
		array( 'year' => '2011', 'name' => 'Gyeonggi CeraMIX Biennale', 'loc_fr' => 'Corée du Sud', 'loc_en' => 'South Korea', 'status' => 'int', 'badge' => 'International' ),
	);
}

function jb_press_images() {
	return array(
		'https://static.wixstatic.com/media/81bdf6_85b484c9d8a6679914dea23e1f9d7b70.jpg/v1/fill/w_506,h_398,al_c,q_80,enc_avif,quality_auto/81bdf6_85b484c9d8a6679914dea23e1f9d7b70.jpg',
		'https://static.wixstatic.com/media/81bdf6_42585301114d399834f317a0a98c1637.jpg/v1/fill/w_396,h_541,al_c,q_80,enc_avif,quality_auto/81bdf6_42585301114d399834f317a0a98c1637.jpg',
		'https://static.wixstatic.com/media/81bdf6_9d449b954a9ddd8faaba32a8939cfe8c.jpg/v1/fill/w_443,h_548,al_c,q_80,enc_avif,quality_auto/81bdf6_9d449b954a9ddd8faaba32a8939cfe8c.jpg',
		'https://static.wixstatic.com/media/81bdf6_74220364de07b7a0dba72f7dfea6f9e8.jpg/v1/fill/w_980,h_1442,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/81bdf6_74220364de07b7a0dba72f7dfea6f9e8.jpg',
	);
}

function jb_press_kits() {
	return array(
		array( 'url' => 'https://12eb1e5d-6990-393b-ff56-b1dc3f7ac632.filesusr.com/ugd/81bdf6_643a414c4be62d50611e03f5347fbbb2.pdf', 'title' => 'CeraMIX Biennale 2011', 'sub_fr' => 'PDF — Gyeonggi, Corée', 'sub_en' => 'PDF — Gyeonggi, Korea' ),
		array( 'url' => 'https://12eb1e5d-6990-393b-ff56-b1dc3f7ac632.filesusr.com/ugd/81bdf6_f2549d388590dbbd16289cf68a90c80b.pdf', 'title' => 'Triennale 2015', 'sub_fr' => 'PDF — Pays-Bas', 'sub_en' => 'PDF — Netherlands' ),
	);
}
