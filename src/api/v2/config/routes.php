<?php

$version = API_VERSION_STRING;

return [
	"GET {$version}/profile" => "profile/profile/view",
	
    "GET {$version}/profile-person" => "profile/person/view",
    "PUT {$version}/profile-person" => "profile/person/update",

    "GET {$version}/profile-address" => "profile/address/view",
    "PUT {$version}/profile-address" => "profile/address/update",

    "GET {$version}/profile-avatar" => "profile/avatar/view",
    "POST {$version}/profile-avatar" => "profile/avatar/update",
    "DELETE {$version}/profile-avatar" => "profile/avatar/delete",
];
