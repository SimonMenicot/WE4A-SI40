<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

const PACKAGE = new PathPackage('', new EmptyVersionStrategy());

function getDemoClassData(string $url): array
{
    return [
        'type' => "container",
        'data' => [
            'is_horizontal' => false,
            'is_wrapping' => false,
            'children' => [
                [
                    'type' => "container",
                    'data' => [
                        'is_horizontal' => false,
                        'is_wrapping' => false,
                        'children' => [
                            [
                                'type' => "raw-text",
                                'data' => "Ceci est un texte brute dans un container vertical"
                            ],
                            [
                                'type' => "raw-text",
                                'data' => "Qu'est-ce que le Lorem Ipsum ?\nLe Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.\nLe morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de \"De Finibus Bonorum et Malorum\" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham."
                            ],
                            [
                                'type' => "rich-text",
                                'data' => '
                        <h2>
                            <em>Ceci est un texte riche</em>
                        </h2>
                        <p>
                            <strong>Charles Stein</strong> est un statisticien américain né le 22 mars 1920 et mort le 24 novembre 2016, professeur émérite de statistiques à <a href="https://fr.wikipedia.org/wiki/Universit%C3%A9_Stanford" target="_blank"> Stanford</a>.
                            Il est connu pour le <a href="https://fr.wikipedia.org/wiki/Paradoxe_de_Stein" target="_blank">paradoxe de Stein</a> en <a href="https://fr.wikipedia.org/wiki/Th%C3%A9orie_de_la_d%C3%A9cision" target="_blank">théorie de la décision</a> et pour la <a href="https://fr.wikipedia.org/wiki/M%C3%A9thode_de_Stein" target="_blank">méthode de Stein</a> qui permet de démontrer le <a href="https://fr.wikipedia.org/wiki/Th%C3%A9or%C3%A8me_central_limite" target="_blank"> central limite</a>.
                        </p>
                        <p>
                            <strong>Auguste Van Assche</strong>, né le 5 juillet 1826 à <a href="https://fr.wikipedia.org/wiki/Gand" target="_blank">Gand</a> et mort le 24 février 1907, est un <a href="https://fr.wikipedia.org/wiki/Architecte" target="_blank">architecte</a> <a href="https://fr.wikipedia.org/wiki/Belgique" target="_blank">belge</a>, auteur de nombreuses restaurations et transformations de bâtiments médiévaux en Belgique.
                        </p>
                                '
                            ],
                        ]
                    ]
                ],
                [
                    'type' => "raw-text",
                    'data' => "Ce qui suit est un container horizontal avec wrap (miam miam)"
                ],
                [
                    'type' => "container",
                    'data' => [
                        'is_horizontal' => true,
                        'is_wrapping' => true,
                        'children' => [
                            [
                                'type' => "file",
                                'data' => [
                                    'description' => "TD1 : Validation/Remise à Niveau PHP/HTML/CSS Fichier",
                                    'filename' => "TD1.zip",
                                    'src' => "https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/TD1.zip"
                                ]
                            ],
                            [
                                'type' => "file",
                                'data' => [
                                    'description' => "TD2 : PHP objet, Javascript",
                                    'filename' => "TD2.zip",
                                    'src' => "https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/TD1.zip"
                                ]
                            ],
                            [
                                'type' => "file",
                                'data' => [
                                    'description' => "TD3 : Version finale du site \"sans javascript\"",
                                    'filename' => "TD3.zip",
                                    'src' => "https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/TD1.zip"
                                ]
                            ],
                            [
                                'type' => "file",
                                'data' => [
                                    'description' => "Le cahier des charges : Le but du projet est de créer une version simplifiée de Moodle, et le cahier des charges vous aidera à mieux situer ce que nous voulons dire par là. Vous devez utiliser Symfony pour pouvoir avoir une note supérieure à 15/20.",
                                    'filename' => "WE4A - Moodle Simplifié (devoir retiré).pdf",
                                    'src' => "https://tests-and-previews.flopcreation.fr/downloads/UTBM - Nooble/WE4A - Moodle Simplifié (devoir retiré).pdf"
                                ]
                            ],
                        ]
                    ]
                ],
                [
                    'type' => "container",
                    'data' => [
                        'is_horizontal' => true,
                        'is_wrapping' => true,
                        'children' => [
                            [
                                'type' => "image",
                                'data' => "https://randomwordgenerator.com/img/picture-generator/55e2dc434c50a814f1dc8460962e33791c3ad6e04e50744074267bd19f4ac2_640.jpg"
                            ],
                            [
                                'type' => "image",
                                'data' => "https://randomwordgenerator.com/img/picture-generator/5fe4d0474255b10ff3d8992cc12c30771037dbf85254784b772779d69f4e_640.jpg"
                            ],
                        ]
                    ]
                ],
                [
                    'type' => "activity",
                    'data' => [
                        'html' => '
    <p>
        Ceci est une activité interactive. 
    </p>

    <button id="activity-button">
        !Cliquez-moi!
    </button>

    <br>

    ',
                        'edit_html' => '
    <p>
        Ceci est une activité interactive. 
    </p>

    <button id="activity-button">
        !Cliquez-moi!
    </button>

    <br>

    <p>
        Cette activité est ici en mode édition (indépendant)
    </p>

    <button class="icon-button">
        <img src="'.$url.'"/>
        <span>Éditer...</span>
    </button>
                        ',
                        'javascript' => '
    DIV.querySelector("button").addEventListener("click", () => [
        alert("Vous avez cliqué!!!")
    ])
    ',
                        'edit_javascript' => '
    DIV.querySelector("button").addEventListener("click", () => [
        alert("Vous avez cliqué!!!")
    ])
                        '
                    ]
                ],
                [
                    'type' => "container",
                    'data' => [
                        'is_horizontal' => true,
                        'is_wrapping' => false,
                        'children' => [
                            [
                                'type' => "integration",
                                'data' => [
                                    'width' => 560,
                                    'height' => 315,
                                    'src' => "https://www.youtube.com/embed/lJIrF4YjHfQ?si=bNKfRgR0zomAqao8",
                                    'permissions' => [
                                        'accelerometer',
                                        'autoplay',
                                        'clipboard-write',
                                        'encrypted-media',
                                        'gyroscope',
                                        'picture-in-picture',
                                        'web-share',
                                        'fullscreen'
                                    ]
                                ]
                            ],
                            [
                                'type' => "raw-text",
                                'data' => "Qu'est-ce que le Lorem Ipsum ?\nLe Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.\nLe morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de \"De Finibus Bonorum et Malorum\" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham."
                            ],
                        ]
                    ]
                ],
                [
                    'type' => "container",
                    'data' => [
                        'is_horizontal' => true,
                        'is_wrapping' => false,
                        'children' => [
                            [
                                'type' => "video",
                                'data' => "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4"
                            ],
                            [
                                'type' => "container",
                                'data' => [
                                    'is_horizontal' =>  false,
                                    'is_wrapping' => false,
                                    'children' => [
                                        [
                                            'type' => "raw-text",
                                            'data' => "Qu'est-ce que le Lorem Ipsum ?\nLe Lorem Ipsum est simplement un faux texte utilisé dans l'industrie de l'impression et du traitement de texte. Depuis les années 1500, il est considéré comme le texte fictif standard, lorsque quelqu'un a pris une galère de caractères pour la mélanger et créer un livre d'exemple typographique. Il est parvenu à survivre non seulement cinq siècles, mais aussi l'entrée dans le traitement électronique du texte, sans être essentiellement modifié. Sa popularité a été renforcée dans les années 1960 avec la sortie des feuilles Letraset contenant des passages de Lorem Ipsum, et plus récemment grâce aux logiciels de publication assistée par ordinateur comme Aldus PageMaker qui incluent des versions de Lorem Ipsum.\nLe morceau standard de Lorem Ipsum utilisé depuis les années 1500 est reproduit ci-dessous pour ceux que cela intéresse. Les sections 1.10.32 et 1.10.33 de \"De Finibus Bonorum et Malorum\" par Cicéron y sont également reproduites dans leur forme originale exacte, accompagnées des versions anglaises traduites en 1914 par H. Rackham."
                                        ],
                                        [
                                            'type' => "audio",
                                            'data' => "https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
                                        ],
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'type' => 'container',
                    'data' => [
                        'is_horizontal' => false,
                        'is_wrapping' => false,
                        'children' => [
                            [
                                'type' => 'raw-text',
                                'data' => "J'en profite pour glisser mon album"
                            ],
                            [
                                'type' => 'integration',
                                'data' => [
                                    'width' => 'auto',
                                    'height' => 352,
                                    'permissions' => [
                                        'autoplay',
                                        'clipboard-write',
                                        'encrypted-media',
                                        'fullscreen',
                                        'picture-in-picture'
                                    ],
                                    'src' => "https://open.spotify.com/embed/album/2UjSSrKiHFeFFb2WNMEv7X?utm_source=generator&theme=0"
                                ]
                            ],
                            [
                                'type' => 'raw-text',
                                'data' => "Écoutez c'est cool",
                            ],
                        ]
                    ]
                ]
            ]
        ]
    ];
};

class AjaxInformationController extends AbstractController
{
    #[Route('/classes/get-content', "get class content")]
    public function render_login(): Response
    {
        return new Response(
            var_export(getDemoClassData(PACKAGE->getUrl("images/icons/settings.png")), true),
            200,
            [
                "Content-Type" => "text/json"
            ]
        );
    }
}

