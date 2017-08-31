// Japanese menu on top for admin
var menuJPAminTop = [
    { "title": "楽天", "link": "rakuten/index.php", "target": "_blank"},
    { "title": "設定", "link": "manage/index.php", "target": "_blank"},
    { "title": "マスタ", "link": "master/index.php", "target": "_blank"},
    { "title": "ショップリスト", "link": "list/index.php", "target": "_blank"},
    { "title": "リンク", "link": "link/index.php", "target": "_blank"},
    { "title": "スイッチ", "link": "switch/index.php"}
];
//Japanese menu on second for admin
var menuJPAdminSecondRakuten = [
    {
        "title": "運用",
        "list":[
            { "title": "楽天　全店舗リセット", "link": "bot_rakuten01/reset.php", "target": "_blank"},
            { "title": "楽天新規リセット", "link": "bot_rakuten02/reset.php", "target": "_blank"},
            { "title": "楽天新規店舗 取得", "link": "bot_rakuten02/index.php", "target": "_blank"},
            { "title": "楽天　全店舗取得", "link": "bot_rakuten01/index.php", "target": "_blank"},
            { "title": "楽天　全店舗一覧", "link": "list_rakuten01/index.php", "target": "_blank"},
            { "title": "すべてのショップを表示する", "link": "list_yahoo01/index.php", "target": "_blank"},
            { "title": "新しいショップを表示する", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "新しいショップ情報を入手する", "link": "bot_yahoo02/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "ponparemall.com",
        "list":[]
    },
    {
        "title": "shopping.yahoo.co.jp",
        "list":[]
    }
];
var menuJPAdminSecondConfig = [
    {
        "title": "楽天",
        "list":[
            { "title": "カテゴリ", "link": "set_rakuten/list.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "カテゴリ", "link": "set_yahoo/list.php", "target": "_blank"}
        ]
    },
];
var menuJPAdminSecondMaster = [
    {
        "title": "マスタ管理",
        "list":[
            { "title": "ユーザ", "link": "master_usr/list.php", "target": "_blank"},
            { "title": "部署", "link": "master_grp/list.php", "target": "_blank"},
            { "title": "メニュー", "link": "master_mnu/list.php", "target": "_blank"},
            { "title": "アイテム", "link": "master_itm/list.php", "target": "_blank"},
            { "title": "操作ログ照会", "link": "system_log/list.php", "target": "_blank"}
        ]
    }
];
var menuJPAdminSecondShoplist = [{
        "title": "Rakuten(楽天)",            
        "list":[
            { "title": "新規店舗", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Vip Shop",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "新規店舗", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];

var menuJPAdminSecondLink = [
    {
        "title": "Rakuten(楽天)",           
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];
//Japanese menu on top for master
var menuJPMasterTop = [
    { "title": "楽天", "link": "rakuten/index.php", "target": "_blank"},
    { "title": "設定", "link": "manage/index.php", "target": "_blank"},
    { "title": "ショップリスト", "link": "list/index.php", "target": "_blank"},
    { "title": "リンク", "link": "link/index.php", "target": "_blank"},
    { "title": "スイッチ", "link": "switch/index.php"}
];
//Japanese menu on second for master
var menuJPMasterSecondRakuten = [
    {
        "title": "運用",            
        "list":[
            { "title": "楽天　全店舗リセット", "link": "bot_rakuten01/reset.php", "target": "_blank"},
            { "title": "楽天新規リセット", "link": "bot_rakuten02/reset.php", "target": "_blank"},
            { "title": "楽天新規店舗 取得", "link": "bot_rakuten02/index.php", "target": "_blank"},
            { "title": "楽天　全店舗取得", "link": "bot_rakuten01/index.php", "target": "_blank"},
            { "title": "楽天　全店舗一覧", "link": "list_rakuten01/index.php", "target": "_blank"},
            { "title": "すべてのショップを表示する", "link": "list_yahoo01/index.php", "target": "_blank"},
            { "title": "新しいショップを表示する", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "新しいショップ情報を入手する", "link": "bot_yahoo02/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "ponparemall.com",
        "list": []
    },
    {
        "title": "shopping.yahoo.co.jp",
        "list": []
    }
];
var menuJPMasterSecondConfig = [
    {
        "title": "楽天",
        "list":[
            { "title": "カテゴリ", "link": "set_rakuten/list.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "カテゴリ", "link": "set_yahoo/list.php", "target": "_blank"}
        ]
    },
];
var menuJPMasterSecondMaster = [
    {
        "title": "マスタ管理",            
        "list":[
            { "title": "ユーザ", "link": "master_usr/list.php", "target": "_blank"},
            { "title": "部署", "link": "master_grp/list.php", "target": "_blank"},
            { "title": "メニュー", "link": "master_mnu/list.php", "target": "_blank"},
            { "title": "アイテム", "link": "master_itm/list.php", "target": "_blank"},
            { "title": "操作ログ照会", "link": "system_log/list.php", "target": "_blank"}
        ]
    }
];
var menuJPMasterSecondShoplist = [
    {
        "title": "Rakuten(楽天)",
        "list":[
            { "title": "新規店舗", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Vip Shop",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "新規店舗", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];
var menuJPMasterSecondLink = [
    {
        "title": "Rakuten(楽天)",            
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];

//Japanese menu on top for user
var menuJPUserTop = [
    { "title": "ショップリスト", "link": "", "target": "_blank"},
    { "title": "リンク", "link": "", "target": "_blank"}
];
//Japanese menu on second for user
var menuJPUserSecondShoplist = [
    {
        "title": "Rakuten(楽天)",
        "list":[
            { "title": "新規店舗", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Vip Shop",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "新規店舗", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];
var menuJPUserSecondLink = [
    {
        "title": "Rakuten(楽天)",            
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];
//English menu on top for admin
var menuUSAdminTop = [
    { "title": "Rakuten", "link": "rakuten/index.php", "target": "_blank"},
    { "title": "Configuration", "link": "manage/index.php", "target": "_blank"},
    { "title": "Master", "link": "master/index.php", "target": "_blank"},
    { "title": "ShopList", "link": "list/index.php", "target": "_blank",},
    { "title": "Link", "link": "link/index.php", "target": "_blank"},
    { "title": "Switch", "link": "switch/index.php", "target": "_blank"}
];

//English menu on second for admin
var menuUSAdminSecondRakuten = [
    {
        "title": "運用",            
        "list":[
            { "title": "Rakuten all store reset", "link": "bot_rakuten01/reset.php", "target": "_blank"},
            { "title": "Rakuten new reset", "link": "bot_rakuten02/reset.php", "target": "_blank"},
            { "title": "Rakuten new store acquisition", "link": "bot_rakuten02/index.php", "target": "_blank"},
            { "title": "Rakuten All stores acquired", "link": "bot_rakuten01/index.php", "target": "_blank"},
            { "title": "All Rakuten stores", "link": "list_rakuten01/index.php", "target": "_blank"},
            { "title": "Show All Shops", "link": "list_yahoo01/index.php", "target": "_blank"},
            { "title": "Show New Shops", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Get New Shops Information", "link": "bot_yahoo02/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "ponparemall.com",
        "list": []
    },
    {
        "title": "shopping.yahoo.co.jp",
        "list": []
    }
];
var menuUSAdminSecondConfig = [
    {
        "title": "Rakuten",            
        "list":[
            { "title": "Category", "link": "set_rakuten/list.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "Category", "link": "set_yahoo/list.php", "target": "_blank"}
        ]
    },
];
var menuUSAdminSecondMaster = [
    {
        "title": "Master Admin",            
        "list":[
            { "title": "User", "link": "master_usr/list.php", "target": "_blank"},
            { "title": "Department", "link": "master_grp/list.php", "target": "_blank"},
            { "title": "Menu", "link": "master_mnu/list.php", "target": "_blank"},
            { "title": "Item", "link": "master_itm/list.php", "target": "_blank"},
            { "title": "Display operation log", "link": "system_log/list.php", "target": "_blank"}
        ]
    }
];
var menuUSAdminSecondShoplist = [
    {
        "title": "Rakuten(楽天)",
        "list":[
            { "title": "NewArraival", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "Search", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Vip Shop",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "NewArraival", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Search", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];
var menuUSAdminSecondLink = [
    {
        "title": "Rakuten(楽天)",
        
        "list":[]
    },
    {
        "title": "Yahoo",
        "ParentMenu": "link",
        "list":[]
    }
];

//English menu on top for master
var menuUSMasterTop = [
    { "title": "Rakuten", "link": "rakuten/index.php", "target": "_blank"},
    { "title": "Configuration", "link": "manage/index.php", "target": "_blank"},
    { "title": "ShopList", "link": "list/index.php", "target": "_blank"},
    { "title": "Link", "link": "link/index.php", "target": "_blank"},
    { "title": "Switch", "link": "switch/index.php", "target": "_blank"}
];
//English menu on second for master
var menuUSMasterSecondRakuten = [
    {
        "title": "Operation",
        "list":[
            { "title": "Rakuten all store reset", "link": "bot_rakuten01/reset.php", "target": "_blank"},
            { "title": "Rakuten new reset", "link": "bot_rakuten02/reset.php", "target": "_blank"},
            { "title": "Rakuten new store acquisition", "link": "bot_rakuten02/index.php", "target": "_blank"},
            { "title": "Rakuten All stores acquired", "link": "bot_rakuten01/index.php", "target": "_blank"},
            { "title": "All Rakuten stores", "link": "list_rakuten01/index.php", "target": "_blank"},
            { "title": "Show All Shops", "link": "list_yahoo01/index.php", "target": "_blank"},
            { "title": "Show New Shops", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Get New Shops Information", "link": "bot_yahoo02/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "ponparemall.com",
        "list": []
    },
    {
        "title": "shopping.yahoo.co.jp",
        "list": []
    }
];
var menuUSMasterSecondConfig = [
    {
        "title": "Rakuten",            
        "list":[
            { "title": "Category", "link": "set_rakuten/list.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "Category", "link": "set_yahoo/list.php", "target": "_blank"}
        ]
    },
];
var menuUSMasterSecondShoplist = [
    {
        "title": "Rakuten(楽天)",            
        "list":[
            { "title": "NewArraival", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "Search", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Vip Shop",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "NewArraival", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Search", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];
var menuUSMasterSecondLink = [
    {
        "title": "Rakuten(楽天)",            
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];

//English menu on top for user
var menuUsUserTop  = [
    { "title": "ShopList", "link": "", "target": "_blank"},
    { "title": "Link", "link": "", "target": "_blank"}
];
//English menu on second for user
var menuUsUserSecondShoplist = [
    {
        "title": "Rakuten(楽天)",
        "list":[
            { "title": "NewArraival", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "Search", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Vip Shop",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "新規店舗", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "Search", "link": "sales_progress/list.php", "target": "_blank"}
        ]
    }
];
var menuUsUserSecondLink = [
    {
        "title": "Rakuten(楽天)",
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];

//VietNamese menu on top for Admin
var menuVnAdminTop = [
    { "title": "Rakuten", "link": "rakuten/index.php", "target": "_blank"},
    { "title": "Cấu hình", "link": "manage/index.php", "target": "_blank"},
    { "title": "chủ", "link": "master/index.php", "target": "_blank"},
    { "title": "Danh sách cửa hàng", "link": "list/index.php", "target": "_blank"},
    { "title": "Đuòng dẫn", "link": "link/index.php", "target": "_blank"},
    { "title": "Công tắc", "link": "switch/index.php", "target": "_blank"}
];
//VietNamese menu on second for Admin
var menuVnAdminSecondRakuten = [
    {
        "title": "Hoạt dộng",
        "list":[
            { "title": "Thiết lập lại các cửa hàng Rakuten", "link": "bot_rakuten01/reset.php", "target": "_blank"},
            { "title": "Thiết lập mới các cửa hàng Rakuten", "link": "bot_rakuten02/reset.php", "target": "_blank"},
            { "title": "Mua lại cửa hàng mới Rakuten", "link": "bot_rakuten02/index.php", "target": "_blank"},
            { "title": "Tất cả các cửa hàng mua lại Rakuten", "link": "bot_rakuten01/index.php", "target": "_blank"},
            { "title": "Danh sách tất cả cửa hàng Rakuten", "link": "list_rakuten01/index.php", "target": "_blank"},
            { "title": "Hiển thị tất cả cửa hàng", "link": "list_yahoo01/index.php", "target": "_blank"},
            { "title": "Hiển thị cửa hàng mới", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Lấy thông tin cửa hàng mới", "link": "bot_yahoo02/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "ponparemall.com",
    },
    {
        "title": "shopping.yahoo.co.jp",
    }
];
var menuVnAdminSecondConfig = [
    {
        "title": "Rakuten",
        
        "list":[
            { "title": "Thể loại", "link": "set_rakuten/list.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "ParentMenu": "config",
        "list":[
            { "title": "Thể loại", "link": "set_yahoo/list.php", "target": "_blank"}
        ]
    },
];
var menuVnAdminSecondMaster = [
    {
        "title": "Quản trị tuyệt đối",            
        "list":[
            { "title": "Người dùng", "link": "master_usr/list.php", "target": "_blank"},
            { "title": "Bộ phận", "link": "master_grp/list.php", "target": "_blank"},
            { "title": "Bảng kê", "link": "master_mnu/list.php", "target": "_blank"},
            { "title": "Danh mục", "link": "master_itm/list.php", "target": "_blank"},
            { "title": "Hiển thị lịch sử hoạt động", "link": "system_log/list.php", "target": "_blank"}
        ]
    }
];
var menuVnAdminSecondShoplist = [
    {
        "title": "Rakuten(楽天)",
        "list":[
            { "title": "Điểm mới", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "Tìm kiếm", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Cửa hàng Vip",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "Điểm mới", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Tìm kiếm", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "Tìm kiếm", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];
var menuVnAdminSecondLink = [
    {
        "title": "Rakuten(楽天)",
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];
//VietNamese menu on top for Master
var menuVnMasterTop  = [
    { "title": "Rakuten", "link": "rakuten/index.php", "target": "_blank"},
    { "title": "Cấu hình", "link": "manage/index.php", "target": "_blank"},
    { "title": "Danh sách cửa hàng", "link": "list/index.php", "target": "_blank"},
    { "title": "Đường dẫn", "link": "link/index.php", "target": "_blank"},
    { "title": "Công tắc", "link": "switch/index.php", "target": "_blank"}
];
//VietNamese menu on second for Master
var menuVnMasterSecondRakuten  = [
    {
        "title": "Operation",            
        "list":[
            { "title": "Thiết lập lại các cửa hàng Rakuten", "link": "bot_rakuten01/reset.php", "target": "_blank"},
            { "title": "Thiết lập mới các cửa hàng Rakuten", "link": "bot_rakuten02/reset.php", "target": "_blank"},
            { "title": "Mua lại cửa hàng mới Rakuten", "link": "bot_rakuten02/index.php", "target": "_blank"},
            { "title": "Tất cả các cửa hàng mua lại Rakuten", "link": "bot_rakuten01/index.php", "target": "_blank"},
            { "title": "Danh sách tất cả cửa hàng Rakuten", "link": "list_rakuten01/index.php", "target": "_blank"},
            { "title": "Hiển thị tất cả cửa hàng", "link": "list_yahoo01/index.php", "target": "_blank"},
            { "title": "Hiển thị cửa hàng mới", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Lấy thông tin cửa hàng mới", "link": "bot_yahoo02/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "ponparemall.com",
    },
    {
        "title": "shopping.yahoo.co.jp",
    }
];

var menuVnMasterSecondConfig  = [
    {
        "title": "Rakuten",            
        "list":[
            { "title": "Thể loại", "link": "set_rakuten/list.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "Thể loại", "link": "set_yahoo/list.php", "target": "_blank"}
        ]
    },
];
var menuVnMasterSecondShoplist  = [
    {
        "title": "Rakuten(楽天)",            
        "list":[
            { "title": "Điểm mới", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "Tìm kiếm", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Cửa hàng Vip",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "NewArraival", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "Tìm kiếm", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "Tìm kiếm", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    }
];
var menuVnMasterSecondLink  = [
    {
        "title": "Rakuten(楽天)",
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];

//VietNamese menu on top for user
var menuVnUserTop  = [
    { "title": "Danh sách cửa hàng", "link": "", "target": "_blank"},
    { "title": "Đường dẫn", "link": "", "target": "_blank"}
];

//VietNamese menu on second for user
var menuVnUserSecondShoplist  = [
    {
        "title": "Rakuten(楽天)",
        "list":[
            { "title": "Điểm mới", "link": "list_rakuten02/index.php", "target": "_blank"},
            { "title": "Tìm kiếm", "link": "list_rakuten03/index.php", "target": "_blank"},
            { "title": "PRSearch", "link": "list_rakuten04/index.php", "target": "_blank"},
            { "title": "PRSearch2", "link": "list_rakuten05/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Cửa hàng Vip",
        "link": "list_rakuten06/index.php",
        "list":[]
    },
    {
        "title": "Yahoo",
        "link": "list_rakuten06/index.php",
        "list":[
            { "title": "新規店舗", "link": "list_yahoo02/index.php", "target": "_blank"},
            { "title": "検索", "link": "list_curama03/index.php", "target": "_blank"}
        ]
    },
    {
        "title": "Yahoo",
        "list":[
            { "title": "Tìm kiếm", "link": "sales_progress/list.php", "target": "_blank"}
        ]
    }
];
var menuVnUserSecondLink = [
    {
        "title": "Rakuten(楽天)",
        "list":[]
    },
    {
        "title": "Yahoo",
        "list":[]
    }
];

// config other text by lang - account -login ...menu lang
var confLang = [
    {
        "code": "001",
        'text': 'JP',
        'auth': 'アカウント',
        'logout': 'ログアウト'
    },
    {
        "code": "002",
        'text': 'US',
        'auth': 'Account',
        'logout': 'Logout'
    },
    {
        "code": "003",
        'text': 'VN',
        'auth': 'Tài khoản',
        'logout': 'đăng xuất'
    }
];

/*
structure of Code is aaa-bb-ccc
aaa: is debug code, 100 is admin, 200 is master, 300 is user ...
bb: position menu, 01 is top menu, 02 is second menu ...
ccc: is lang code, 001 is JP, 002 is US, 003 is VN..
    this code use to map to confLang to get account text, language text by lang

pageid is path url of parent page will show this menu (show on parent page and it's child page), if not exist, mean show on all page
such as shoplist have pageid = list/index
 */
var configMenu = new Object();
configMenu.menuMode = "php"; // php or html or "" if php => all link such as master.html => master.php if "" no change extension file
configMenu.confMenu = [
    // Japanese
    {"code": "100-01-001", "Menu": menuJPAminTop},
    {"code": "100-02-001", "pageid": "rakuten/index", "Menu": menuJPAdminSecondRakuten},
    {"code": "100-02-001", "pageid": "manage/index", "Menu": menuJPAdminSecondConfig},
    {"code": "100-02-001", "pageid": "master/index", "Menu": menuJPAdminSecondMaster},
    {"code": "100-02-001", "pageid": "list/index", "Menu": menuJPAdminSecondShoplist},
    {"code": "100-02-001", "pageid": "link/index", "Menu": menuJPAdminSecondLink},

    {"code": "200-01-001", "Menu": menuJPMasterTop},
    {"code": "200-02-001", "pageid": "rakuten/index", "Menu": menuJPAdminSecondRakuten},
    {"code": "200-02-001", "pageid": "manage/index", "Menu": menuJPAdminSecondConfig},
    {"code": "200-02-001", "pageid": "list/index", "Menu": menuJPAdminSecondShoplist},
    {"code": "200-02-001", "pageid": "link/index", "Menu": menuJPAdminSecondLink},

    {"code": "300-01-001", "Menu": menuJPUserTop},
    {"code": "300-02-001", "pageid": "list/index", "Menu": menuJPUserSecondShoplist},
    {"code": "300-02-001", "pageid": "link/index", "Menu": menuJPUserSecondLink},

    //English
    {"code": "100-01-002", "Menu": menuUSAdminTop},
    {"code": "100-02-002", "pageid": "rakuten/index", "Menu": menuUSAdminSecondRakuten},
    {"code": "100-02-002", "pageid": "manage/index", "Menu": menuUSAdminSecondConfig},
    {"code": "100-02-002", "pageid": "master/index", "Menu": menuUSAdminSecondMaster},
    {"code": "100-02-002", "pageid": "list/index", "Menu": menuUSAdminSecondShoplist},
    {"code": "100-02-002", "pageid": "link/index", "Menu": menuUSAdminSecondLink},

    {"code": "200-01-002", "Menu": menuUSMasterTop},
    {"code": "200-02-002", "pageid": "rakuten/index", "Menu": menuUSMasterSecondRakuten},
    {"code": "200-02-002", "pageid": "manage/index", "Menu": menuUSMasterSecondConfig},
    {"code": "200-02-002", "pageid": "list/index", "Menu": menuUSMasterSecondShoplist},
    {"code": "200-02-002", "pageid": "link/index", "Menu": menuUSMasterSecondLink},

    {"code": "300-01-002", "Menu": menuUsUserTop},
    {"code": "300-02-002", "pageid": "list/index", "Menu": menuUsUserSecondShoplist},
    {"code": "300-02-002", "pageid": "link/index", "Menu": menuUsUserSecondLink},

    //Viet Nam
    {"code": "100-01-003", "Menu": menuVnAdminTop},
    {"code": "100-02-003", "pageid": "rakuten/index", "Menu": menuVnAdminSecondRakuten},
    {"code": "100-02-003", "pageid": "manage/index", "Menu": menuVnAdminSecondConfig},
    {"code": "100-02-003", "pageid": "master/index", "Menu": menuVnAdminSecondMaster},
    {"code": "100-02-003", "pageid": "list/index", "Menu": menuVnAdminSecondShoplist},
    {"code": "100-02-003", "pageid": "link/index", "Menu": menuVnAdminSecondLink},

    {"code": "200-01-003", "Menu": menuVnMasterTop},
    {"code": "200-02-003", "pageid": "rakuten/index", "Menu": menuVnMasterSecondRakuten},
    {"code": "200-02-003", "pageid": "manage/index", "Menu": menuVnMasterSecondConfig},
    {"code": "200-02-003", "pageid": "list/index", "Menu": menuVnMasterSecondShoplist},
    {"code": "200-02-003", "pageid": "link/index", "Menu": menuVnMasterSecondLink},

    {"code": "300-01-003", "Menu": menuVnUserTop},
    {"code": "300-02-003", "pageid": "list/index", "Menu": menuVnUserSecondShoplist},
    {"code": "300-02-003", "pageid": "link/index", "Menu": menuVnUserSecondLink}
];