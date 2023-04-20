<?php

namespace Database\Factories;

use App\Helpers\Qs;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
/**
* The name of the factory's corresponding model.
*
* @var string
*/
    protected $model = User::class;

/**
* Define the model's default state.
*
* @return array
*/
    public function definition()
    {
        // Create random User Type
        $user_type = Qs::getStaff(['super_admin', 'librarian'])[rand(0,2)];
        $ho = ['Lê Văn', 'Lê Thị', 'Nguyễn Văn', 'Nguyễn Thị', 'Trần Văn', 'Trần thị', 'Hoàng Văn', 'Hoàng Thị', 'Trương Văn', 'Trương Thị', 'Trần Đình', 'Trần Vũ'];
        $ten = ['Xuân', 'Hạ', 'Thu', 'Tây', 'Đông', 'Nam', 'Bắc', 'Huyền', 'Phương', 'Toàn', 'Ánh', 'Hoàng'];
        $name = $ho[random_int(0, 11)].' '.$ten[random_int(0, 11)];
        $email = $name;
        $email = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $email);
		$email = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $email);
		$email = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $email);
		$email = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $email);
		$email = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $email);
		$email = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $email);
		$email = preg_replace("/(đ)/", 'd', $email);
		$email = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $email);
		$email = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $email);
		$email = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $email);
		$email = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $email);
		$email = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $email);
		$email = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $email);
		$email = preg_replace("/(Đ)/", 'D', $email);
		$email = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $email);
		$email = preg_replace("/( )/", '_', $email);
        $email = strtolower($email);
        return [
            'name' => $name,
            'email' => $email.'@gmail.com',
            'username' => $email,
            'password' => Hash::make($user_type),
            'user_type' => $user_type,
            'code' => strtoupper(Str::random(10)),
            'remember_token' => Str::random(10),
        ];
    }
}
