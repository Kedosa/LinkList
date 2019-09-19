<?php

$menu = array(
    'info_allgemein' => array(
        'headline' => 'Allgemein',
        'category' => 'generell',
        'zeiterfassung_neu' => array(
            'block' => array(
                'name' => "Zeiterfassung (ESS !NUR im IE oder Firefox mit Tool!)",
                'target' => "_blank",
                'link' => 'http://ess.circit.de/SitePages/Homepage.aspx',
                'icon' => "fa-hourglass-half",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        ),
        'zeiterfassung_alternative' => array(
            'block' => array(
                'name' => "Zeiterfassungstool (Tool für Firefox!)",
                'target' => "_blank",
                'link' => 'http://s14lgit01.rs.rbpd.de/gogs/j.bleicher/biggeress.ls',
                'icon' => "fa-cog",
                'comment' => "Anweisungen für die Installation sind auf der Webseite.",
                'type' => 'generell_allgemein'
            )
        ),
        'itsm' => array(
            'block' => array(
                'name' => "ISTM (!NUR im IE!)",
                'target' => "_blank",
                'link' => 'http://s01wdb71.circit.de:8000/sap/bc/bsp/sap/crm_ui_start/default.htm?sap-client=600&sap-sessioncmd=open',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        ),
        'intranet_cirit' => array(
            'block' => array(
                'name' => "Intranet-Circ IT",
                'target' => "_blank",
                'link' => 'http://intranet.circit.de/default.aspx',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        ),
        'intranet_rp' => array(
            'block' => array(
                'name' => "Intranet-RP",
                'target' => "_blank",
                'link' => 'https://intranet.rheinischepostmediengruppe.de/',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        ),
        'jira' => array(
            'block' => array(
                'name' => "Jira",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/jira/secure/Dashboard.jspa',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        ),
        'confluence' => array(
            'block' => array(
                'name' => "Confluence",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/index.action#all-updates',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        ),
        'time_portal' => array(
            'block' => array(
                'name' => "Portal Zeitmanagement",
                'target' => "_blank",
                'link' => 'https://zea-portal.sz-gruppe.de/otrs/customer.pl',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_allgemein'
            )
        )
    ),//allgemein
    'info_bereitschaft' => array(
        'headline' => 'Bereitschaft',
        'category' => 'generell',
        'bereitschaftskalender' => array(
            'block' => array(
                'name' => "Bereitschaftskalender",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/bhkal_2017/',
                'icon' => "fa-calendar",
                'comment' => "",
                'type' => 'generell_bereitschaft'
            )
        ),
        'bereitschaftskalender_admin' => array(
            'block' => array(
                'name' => "Bereitschaftskalender-Administration",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/bhkal_2017/admin/',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_bereitschaft'
            )
        ),
        'hotline' => array(
            'block' => array(
                'name' => "Hotline umstellen",
                'target' => "_blank",
                'link' => 'http://s01wtel01.circit.de:7789/tweb/portal/req?loadWebPortal',
                'icon' => "fa-phone",
                'comment' => "",
                'type' => 'generell_bereitschaft'
            )
        ),
        'cirit_portal' => array(
            'block' => array(
                'name' => "Circ IT - Portal",
                'target' => "_blank",
                'link' => 'https://portal.circit.de/dana-na/auth/url_104/welcome.cgi',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_bereitschaft'
            )
        ),
        'cirit_webapp' => array(
            'block' => array(
                'name' => "Circ IT - Citrix (WebApp)",
                'target' => "_blank",
                'link' => 'https://webapp.circit.de/Citrix/XenApp/site/preferences.aspx',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_bereitschaft'

            )
        ),
        'produktionsverantwortung' => array(
            'block' => array(
                'name' => "Produktionsverantwortung",
                'target' => "_blank",
                'link' => 'http://intranet.circit.de/Betrieb/Lists/Produktionsverantwortung/calendar.aspx',
                'icon' => "fa-calendar",
                'comment' => "",
                'type' => 'generell_bereitschaft'
            )
        )
    ),//bereitschaft

    'info_dokumentation' => array(
        'headline' => 'Dokumentation',
        'category' => 'generell',
        'notfallhandbuch' => array(
            'block' => array(
                'name' => "Notfallhandbuch",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/CINHB/CircIT+IT+Notfallhandbuch',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_dokumentation'
            )
        ),
        'betriebshandbuch' => array(
            'block' => array(
                'name' => "Betriebshandbuch",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/GERAPILOT/ZZZ__Kopfteil+und+ToDos',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_dokumentation'
            )
        )
    ),//dokumentation
    'info_weitere_zugaenge' => array(
        'headline' => 'Weitere Zugänge',
        'category' => 'generell',
        'webmaster' => array(
            'block' => array(
                'name' => "Webmaster Startseite",
                'target' => "_blank",
                'link' => 'http://webmaster.circit.de/',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_weitere_zugaenge'
            )
        ),
        'gogs' => array(
            'block' => array(
                'name' => "Git Gogs",
                'target' => "_blank",
                'link' => 'http://s14lgit01.rs.rbpd.de/gogs/',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'generell_weitere_zugaenge'
            )
        )
    ), //weitere_links
    'info_confluence_wichtig' => array(
        'headline' => 'Confluence Wichtig',
        'category' => 'generell',
        'env' => array(
            'block' => array(
                'name' => "ENV-Variable",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/pages/viewpage.action?spaceKey=RELAUNCH2018&title=ENV+-+Global+Properties',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_confluence_wichtig'
            )
        ),
        'change_prod' => array(
            'block' => array(
                'name' => "Anpassungen Prod-System",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/pages/viewpage.action?pageId=337936714',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_confluence_wichtig'
            )
        ),
        'change_ebf' => array(
            'block' => array(
                'name' => "EBF-Einspielungen",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/pages/viewpage.action?spaceKey=interred&title=GERA-EBF-Changelog+-+Paket+V17.3.0',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_confluence_wichtig'
            )
        ),
        'deployment' => array(
            'block' => array(
                'name' => "Sprint-Deployment",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/interred/Sprint+Deployment',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'generell_confluence_wichtig'
            )
        )
    ),
    'zufall' => array(
        'headline' => 'Test',
        'category' => 'kevin',
        'bereitschaftskalender' => array(
            'block' => array(
                'name' => "Bereitschaftskalender",
                'target' => "_blank",
                'link' => 'https://atlus.com/p5r/',
                'icon' => "fa-star",
                'comment' => "",
                'type' => 'test'
            )
        )
    ),
    'poo' => array(
        'headline' => 'persona',
        'category' => 'Atlus',
        'persona 5 royal' => array(
            'block' => array(
                'name' => "Persona 5 Royal",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/bhkal_2017/',
                'icon' => "fa-star",
                'comment' => "",
                'type' => 'persona'
            )
        )
    ),//confluence_wichtig
    // PAGE INTERRED
    'info_interred_systeme' => array(
        'headline' => 'InterRed Systeme',
        'category' => 'interred',
        'cirit_test' => array(
            'block' => array(
                'name' => "circ IT-Test",
                'target' => "_blank",
                'link' => 'https://cms-circit.gera-interred.de/exec/login.pl',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_test' => array(
            'block' => array(
                'name' => "Gera-Test",
                'target' => "_blank",
                'link' => 'https://cms-test.gera-interred.de/exec/login.pl',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_test_RPD' => array(
            'block' => array(
                'name' => "RPD-Test",
                'target' => "_blank",
                'link' => 'http://cms-rpd.gera-interred.de',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_integration' => array(
            'block' => array(
                'name' => "Gera-Integration",
                'target' => "_blank",
                'link' => 'https://cms-int.gera-interred.de/exec/login.pl',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_schulung' => array(
            'block' => array(
                'name' => "Gera-Schulung",
                'target' => "_blank",
                'link' => 'https://cms-schulung.gera-interred.de/exec/login.pl',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_produktion' => array(
            'block' => array(
                'name' => "Gera-Produktion",
                'target' => "_blank",
                'link' => 'https://cms.gera-interred.de/exec/login.pl',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_systeme'
             )
        )
    ),//interred
    'info_interred_weitere_zugaenge' => array(
        'headline' => 'InterRed weitere Zugänge',
        'category' => 'interred',
        'interred_git' => array(
            'block' => array(
                'name' => "InterRed GIT",
                'target' => "_blank",
                'link' => 'http://s14lgit01.rs.rbpd.de/gogs/',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_git_phpMyAdmin' => array(
            'block' => array(
                'name' => "phpMyAdmin",
                'target' => "_blank",
                'link' => 'https://cms-circit.gera-interred.de/pm_admin/',
                'icon' => "fa-cog",
                'comment' => "User: interred PW: kwid+m-p,WbDDp6!",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_googledrive' => array(
            'block' => array(
                'name' => "InterRed GoogleDrive",
                'target' => "_blank",
                'link' => 'https://drive.google.com/drive/folders/0Bz0q4c0vN2L3Ujd4VEMtdlVRWDg',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_troubleshooting' => array(
            'block' => array(
                'name' => "InterRed Troubleshooting",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/GERAPILOT/Troubleshooting',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_support' => array(
            'block' => array(
                'name' => "Supportseite von InterRed",
                'target' => "_blank",
                'link' => 'http://www.interred.de/support',
                'icon' => "fa-cog",
                'comment' => "User: circit PW: 3p9dm2xf",
                'type' => 'interred_weitere_zugaenge'
            )
        )
    ),//weitere_links
    'info_interred_dokumentation' => array(
        'headline' => 'InterRed Dokumentation',
        'category' => 'interred',
        'php_includes' => array(
            'block' => array(
                'name' => "InterRed PHP Includes Doku",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/dokumentation/interred/index.php',
                'icon' => "fa-info-circle",
                'comment' => "",
                'type' => 'interred_dokumentation'
            )
        )
    ),//Gogs
    'info_leoevent' => array(
        'headline' => 'Leoevent',
        'category' => 'other',
        'rp_prod' => array(
            'block' => array(
                'name' => "RP PROD",
                'target' => "_blank",
                'link' => 'http://leorp.rbpd.de/leoevent/start.html',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'leoevent'
            )
        ),
        'wz_prod' => array(
            'block' => array(
                'name' => "WZ PROD",
                'target' => "_blank",
                'link' => 'http://leowz.rbpd.de/leoevent/start.html',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'leoevent'
            )
        ),
        'zva_prod' => array(
            'block' => array(
                'name' => "ZVA PROD",
                'target' => "_blank",
                'link' => 'http://149.221.2.20:8082/leoevent/',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'leoevent'
            )
        )
    ),
    'info_iapps-workflow' => array(
        'headline' => 'Iapps-workflow',
        'category' => 'other',
        'mail-uebersicht' => array(
            'block' => array(
                'name' => "Mail-Übersicht",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/workflow_iapps/?date=0',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'iapps-workflow'
            )
        ),
        'web-epaper' => array(
            'block' => array(
                'name' => "WEB-ePaper",
                'target' => "_blank",
                'link' => 'https://rp-epaper.s4p-iapps.com/intranet/',
                'icon' => "fa-cog",
                'comment' => "",
                'type' => 'iapps-workflow'
            )
        )
    )
);//$menu