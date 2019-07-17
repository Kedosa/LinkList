<?php

$menu = array(
    'info_allgemein' => array(
        'headline' => 'Allgemein',
        'zeiterfassung_alt' => array(
            'block' => array(
                'name' => "Zeiterfassung (alt)",
                'target' => "_blank",
                'link' => 'http://ze.circit.de/PortalCircIT/Default.aspx?tabid=62',
                'icon' => "glyphicon-time",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'zeiterfassung_neu' => array(
            'block' => array(
                'name' => "Zeiterfassung (ESS !NUR im IE!)",
                'target' => "_blank",
                'link' => 'http://ess.circit.de/SitePages/Homepage.aspx',
                'icon' => "glyphicon-time",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'itsm' => array(
            'block' => array(
                'name' => "ISTM (!NUR im IE!)",
                'target' => "_blank",
                'link' => 'http://s01wdb71.circit.de:8000/sap/bc/bsp/sap/crm_ui_start/default.htm?sap-client=600&sap-sessioncmd=open',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'intranet_cirit' => array(
            'block' => array(
                'name' => "Intranet-Circ IT",
                'target' => "_blank",
                'link' => 'http://intranet.circit.de/default.aspx',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'intranet_rp' => array(
            'block' => array(
                'name' => "Intranet-RP",
                'target' => "_blank",
                'link' => 'https://intranet.rheinischepostmediengruppe.de/',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'jira' => array(
            'block' => array(
                'name' => "Jira",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/jira/secure/Dashboard.jspa',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'confluence' => array(
            'block' => array(
                'name' => "Confluence",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/index.action#all-updates',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'allgemein'
            )
        ),
        'time_portal' => array(
            'block' => array(
                'name' => "Portal Zeitmanagement",
                'target' => "_blank",
                'link' => 'https://zea-portal.sz-gruppe.de/otrs/customer.pl',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'allgemein'
            )
        )
    ),//allgemein
    'info_bereitschaft' => array(
        'headline' => 'Bereitschaft',
        'bereitschaftskalender' => array(
            'block' => array(
                'name' => "Bereitschaftskalender",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/bhkal_2017/',
                'icon' => "glyphicon-calendar",
                'comment' => "",
                'type' => 'bereitschaft'
            )
        ),
        'bereitschaftskalender_admin' => array(
            'block' => array(
                'name' => "Bereitschaftskalender-Administration",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/bhkal_2017/admin/',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'bereitschaft'
            )
        ),
        'hotline' => array(
            'block' => array(
                'name' => "Hotline umstellen",
                'target' => "_blank",
                'link' => 'http://s01wtel01.circit.de:7789/tweb/portal/req?loadWebPortal',
                'icon' => "glyphicon-phone",
                'comment' => "",
                'type' => 'bereitschaft'
            )
        ),
        'cirit_portal' => array(
            'block' => array(
                'name' => "Circ IT - Portal",
                'target' => "_blank",
                'link' => 'https://portal.circit.de/dana-na/auth/url_104/welcome.cgi',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'bereitschaft'
            )
        ),
        'cirit_webapp' => array(
            'block' => array(
                'name' => "Circ IT - Citrix (WebApp)",
                'target' => "_blank",
                'link' => 'https://webapp.circit.de/Citrix/XenApp/site/preferences.aspx',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'bereitschaft'

            )
        ),
        'produktionsverantwortung' => array(
            'block' => array(
                'name' => "Produktionsverantwortung",
                'target' => "_blank",
                'link' => 'http://intranet.circit.de/Betrieb/Lists/Produktionsverantwortung/calendar.aspx',
                'icon' => "glyphicon-calendar",
                'comment' => "",
                'type' => 'bereitschaft'
            )
        )
    ),//bereitschaft

    'info_dokumentation' => array(
        'headline' => 'Dokumentation',
        'notfallhandbuch' => array(
            'block' => array(
                'name' => "Notfallhandbuch",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/CINHB/CircIT+IT+Notfallhandbuch',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'dokumentation'
            )
        ),
        'betriebshandbuch' => array(
            'block' => array(
                'name' => "Betriebshandbuch",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/GERAPILOT/ZZZ__Kopfteil+und+ToDos',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'dokumentation'
            )
        )
    ),//dokumentation
    'info_weitere_zugaenge' => array(
        'headline' => 'Weitere Zugänge',
        'webmaster' => array(
            'block' => array(
                'name' => "Webmaster Startseite",
                'target' => "_blank",
                'link' => 'http://webmaster.circit.de/',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'weitere_zugaenge'
            )
        ),
        'gogs' => array(
            'block' => array(
                'name' => "Git Gogs",
                'target' => "_blank",
                'link' => 'http://s14lgit01.rs.rbpd.de/gogs/',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'weitere_zugaenge'
            )
        )
    ),//weitere_links
    'info_confluence_wichtig' => array(
        'headline' => 'Confluence Wichtig',
        'env' => array(
            'block' => array(
                'name' => "ENV-Variable",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/pages/viewpage.action?spaceKey=RELAUNCH2018&title=ENV+-+Global+Properties',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'confluence_wichtig'
            )
        ),
        'change_prod' => array(
            'block' => array(
                'name' => "Anpassungen Prod-System",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/pages/viewpage.action?pageId=337936714',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'confluence_wichtig'
            )
        ),
        'change_ebf' => array(
            'block' => array(
                'name' => "EBF-Einspielungen",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/pages/viewpage.action?spaceKey=interred&title=GERA-EBF-Changelog+-+Paket+V17.3.0',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'confluence_wichtig'
            )
        ),
        'deployment' => array(
            'block' => array(
                'name' => "Sprint-Deployment",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/interred/Sprint+Deployment',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'confluence_wichtig'
            )
        )
    ),//confluence_wichtig
    // PAGE INTERRED

    'info_interred_systeme' => array(
        'headline' => 'InterRed Systeme',
        'cirit_test' => array(
            'block' => array(
                'name' => "circ IT-Test",
                'target' => "_blank",
                'link' => 'https://cms-circit.gera-interred.de/exec/login.pl',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_test' => array(
            'block' => array(
                'name' => "Gera-Test",
                'target' => "_blank",
                'link' => 'https://cms-test.gera-interred.de/exec/login.pl',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_test_RPD' => array(
            'block' => array(
                'name' => "RPD-Test",
                'target' => "_blank",
                'link' => 'http://cms-rpd.gera-interred.de',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_integration' => array(
            'block' => array(
                'name' => "Gera-Integration",
                'target' => "_blank",
                'link' => 'https://cms-int.gera-interred.de/exec/login.pl',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_schulung' => array(
            'block' => array(
                'name' => "Gera-Schulung",
                'target' => "_blank",
                'link' => 'https://cms-schulung.gera-interred.de/exec/login.pl',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        ),
        'gera_produktion' => array(
            'block' => array(
                'name' => "Gera-Produktion",
                'target' => "_blank",
                'link' => 'https://cms.gera-interred.de/exec/login.pl',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_systeme'
            )
        )
    ),//interred
    'info_interred_weitere_zugaenge' => array(
        'headline' => 'InterRed weitere Zugänge',
        'interred_git' => array(
            'block' => array(
                'name' => "InterRed GIT",
                'target' => "_blank",
                'link' => 'http://s14lgit01.rs.rbpd.de/gogs/',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_git_phpMyAdmin' => array(
            'block' => array(
                'name' => "phpMyAdmin",
                'target' => "_blank",
                'link' => 'https://cms-circit.gera-interred.de/pm_admin/',
                'icon' => "glyphicon-cog",
                'comment' => "User: interred PW: kwid+m-p,WbDDp6!",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_googledrive' => array(
            'block' => array(
                'name' => "InterRed GoogleDrive",
                'target' => "_blank",
                'link' => 'https://drive.google.com/drive/folders/0Bz0q4c0vN2L3Ujd4VEMtdlVRWDg',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_troubleshooting' => array(
            'block' => array(
                'name' => "InterRed Troubleshooting",
                'target' => "_blank",
                'link' => 'https://prom.circit.de/confluence/display/GERAPILOT/Troubleshooting',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'interred_weitere_zugaenge'
            )
        ),
        'interred_support' => array(
            'block' => array(
                'name' => "Supportseite von InterRed",
                'target' => "_blank",
                'link' => 'http://www.interred.de/support',
                'icon' => "glyphicon-cog",
                'comment' => "User: circit PW: 3p9dm2xf",
                'type' => 'interred_weitere_zugaenge'
            )
        )
    ),//weitere_links
    'info_interred_dokumentation' => array(
        'headline' => 'InterRed Dokumentation',
        'php_includes' => array(
            'block' => array(
                'name' => "InterRed PHP Includes Doku",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/dokumentation/interred/index.php',
                'icon' => "glyphicon-info-sign",
                'comment' => "",
                'type' => 'interred_dokumentation'
            )
        )
    ),//Gogs
    'info_leoevent' => array(
        'headline' => 'Leoevent',
        'rp_prod' => array(
            'block' => array(
                'name' => "RP PROD",
                'target' => "_blank",
                'link' => 'http://leorp.rbpd.de/leoevent/start.html',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'leoevent'
            )
        ),
        'wz_prod' => array(
            'block' => array(
                'name' => "WZ PROD",
                'target' => "_blank",
                'link' => 'http://leowz.rbpd.de/leoevent/start.html',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'leoevent'
            )
        ),
        'zva_prod' => array(
            'block' => array(
                'name' => "ZVA PROD",
                'target' => "_blank",
                'link' => 'http://149.221.2.20:8082/leoevent/',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'leoevent'
            )
        )
    ),
    'info_iapps-workflow' => array(
        'headline' => 'iapps-Workflow',
        'mail-uebersicht' => array(
            'block' => array(
                'name' => "Mail-Übersicht",
                'target' => "_blank",
                'link' => 'http://s98wapmo01.circit-net.de/workflow_iapps/?date=0',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'iapps-workflow'
            )
        ),
        'web-epaper' => array(
            'block' => array(
                'name' => "WEB-ePaper",
                'target' => "_blank",
                'link' => 'https://rp-epaper.s4p-iapps.com/intranet/',
                'icon' => "glyphicon-cog",
                'comment' => "",
                'type' => 'iapps-workflow'
            )
        )
    )
);//$menu