Yii2 Bizgod Module
==============

Module Bizgod for quickly write composer module. Just extract it and search replace the work `bizgod` with `yourModuleName`. Then rename the file `BizgodModule` to `YourModule`.

That is all!

## Usage

Use github to fork this repository.

To create the message, navigate on the module directory after clone then run the following command:

~~~
../../../yii message/extract message-config.php
~~~

To install the schema after writing your migration:

~~~
../../../yii migrate/up --migrationPath=@vendor/istt/yii2-bizgod-module/migrations
~~~

## Install

Modify the composer.json of your project:

~~~
[json]
 "repositories": [
        ...
        {
          "type": "vcs",
          "url": "https://github.com/istt/yii2-bizgod-module",
          "reference":"master"
        },
        ...
],
"require": {
                ...
                "istt/yii2-bizgod-module":"*",
                ...
        },
~~~

Then run the following commands:

~~~
[bash]
php composer.phar update
./yii migrate/up --migrationPath=@vendor/istt/yii2-bizgod-module/migrations
~~~

Last, add the module to your config file

~~~
[php]
	'modules' => [
		...
		'project' => 'istt\bizgod\BizgodModule',
		...
	],
~~~

In your main layout file:

~~~
[php]
$items =  [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
        Yii::$app->user->isGuest ?
            ['label' => 'Login', 'url' => ['/site/login']] :
            ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']],
    ];
 foreach (\Yii::$app->modules as $id => $child) {
	$module = \Yii::$app->getModule($id);
	if ($module && (file_exists($phpFile = $module->getViewPath() . '/layouts/_menu' . ucfirst($id) . '.php'))) {
		$items = array_merge_recursive($items, require($phpFile));
	}
}
~~~


# BizGod Module

- Order Type có 3 loại:
    - Invite All Supplier: Gửi Invite tới tất cả các supplier
    - Limit for Certified Supplier: Chỉ gửi Invite cho các Supplier có sản phẩm và đã được certify
    - Select Supplier: Đưa ra danh sách ác supplier có sản phẩm. Khách hàng tự lựa chọn các Supplier sẽ gửi Invite
- Customer Type: Cá nhân vs Tổ chức
- Rating Type:
    - Customer rate cho Supplier
    - Ngược lại
- Order Status:
    1 - Mới tạo và đang gửi Invite
    2 - Hoàn thành việc gửi Invite
    3 - Đã chốt PO
- Response Type:
    - Customer Response
    - Supplier Response
- PO Status:
    1 - Mới chốt, chưa giao hàng
    2 - Đã giao hàng, chưa thanh toán
    3 - Đã giao hàng + thanh toán
    4 - Đã hết thời gian khiếu nại / đổi hàng
    5 - Đã hết thời gian rating