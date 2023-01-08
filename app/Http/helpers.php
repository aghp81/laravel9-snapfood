    <?php

// تبدیل تاریخ میلادی به شمسی 

function persianDate($enDate)
{
    $faDate = \Morilog\Jalali\Jalalian::fromCarbon($enDate);
    return $faDate->format('Y-m-d');
}



// اپلود تصاویر

function short($string, $max=50)
{
    return mb_strlen($string) > $max ? mb_substr($string, 0, $max).'...' : $string;
}

function upload($newFile)
{
    $filename = randomSHA().".".$newFile->getClientOriginalExtension();
    $newFile->move(base_path('storage/app/public'), $filename);
    return "storage/$filename";
}

function deleteFile($path)
{
    \File::delete($path);
}

function randomSHA()
{
    return bin2hex(random_bytes(10));
}

// نمایش ای دی فروشگاهی که لاگین کرده.
function currentShopId() 
{ 
    $shop = \app\Shop::where('user_id', auth()->id())->firstOrFail(); // اونجایی که آی دی کاربر با آی دی شخصی که لاگین کرده برابره
    return $shop->id ?? 0; // اگر ای دی را پیدا کرد که کرد اگر نکرد 0 یعنی هیچ کدوم رو برمی گردونه
}
