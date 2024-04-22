<?php
/*
@copyright

Fleet Manager v6.5

Copyright (C) 2017-2023 Hyvikk Solutions <https://hyvikk.com/> All rights reserved.
Design and developed by Hyvikk Solutions <https://hyvikk.com/>

 */
namespace App\Rules;

use App\Model\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueLicenceNumber implements Rule {

	public function passes($attribute, $value) {
		if (\Request::get("edit") == "1") {
			$license_number = User::meta()
				->where(function ($query) {
					$query->where('users_meta.key', '=', 'license_number')
						->where('users_meta.value', '=', \Request::get('license_number'))
						->where('users_meta.user_id', '!=', \Request::get('id'));
				})->exists();
			if (!$license_number) {
				return true;
			} else {
				return false;
			}
		} else {
			$license_number = User::meta()
				->where(function ($query) {
					$query->where('users_meta.key', '=', 'license_number')
						->where('users_meta.value', '=', \Request::get('license_number'));
				})->exists();
			if (!$license_number) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function message() {
		return 'The :attribute must be unique.';
	}
}
