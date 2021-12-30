<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $appends = ['image_path'];



    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country',
        'city',
        'mobile_number',
        'password',
        'first_name',
        'last_name',
        'country',
        'city',
        'mobile_number',
        'image_url',
        'type',
        'status',
        'code',
        'email_verified_at',
        'nationality',
        'id_number',
        'request_sent',
        'need'
    ];


    protected $hidden = [
        'password',
        'remember_token',
        'code',
        'image_url'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }
    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'user_id');
    }
    public function owner()
    {
        return $this->hasOne(Owner::class, 'user_id');
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'interested_users');
    }

    static $term_en = "Contrary to popular belief, Lorem Ipsum is
    not simply random text. It has roots in a
    piece of classical Latin literature from 45
    BC, making it over 2000 years old. Richard
    McClintock, a Latin professor at HampdenSydney College in Virginia, looked up one of
    the more obscure Latin words, consectetur,
    from a Lorem Ipsum passage, and going
    through the cites of the word in classical
    literature, discovered the undoubtable 
    source. Lorem Ipsum comes from sections
    1.10.32 and 1.10.33 of “de Finibus Bonorum 
    et Malorum” (The Extremes of Good and
    Evil) by Cicero, written in 45 BC. This book is
    a treatise on the theory of ethics, very
    popular during the Renaissance. The first
    line of Lorem Ipsum, “Lorem ipsum dolor sit
    amet..”, comes from a line in section 1.10.32.
    The standard chunk of Lorem Ipsum used
    since the 1500s is reproduced below for
    those interested. Sections 1.10.32 and
    1.10.33 from “de Finibus Bonorum et
    Malorum” by Cicero are also reproduced in
    their exact original form, accompanied by
    English versions from the 1914 translation
    by H. Rackham.
    Contrary to popular belief, Lorem Ipsum is
    not simply random text. It has roots in a
    piece of classical Latin literature from 45
    BC, making it over 2000 years old. Richard
    McClintock, a Latin professor at Hampden";

    static $term_ar = 'خلافا للاعتقاد الشائع ، فإن Lorem Ipsum هو
    ليس مجرد نص عشوائي. لها جذور في أ
    قطعة من الأدب اللاتيني الكلاسيكي من 45
    قبل الميلاد ، مما يجعلها أكثر من 2000 سنة. ريتشارد
    بحث مكلينتوك ، أستاذ اللغة اللاتينية في كلية هامبدن سيدني في فيرجينيا ، عن أحد
    الكلمات اللاتينية الأكثر غموضًا ، consectetur ،
    من ممر لوريم إيبسوم ، وانطلق
    من خلال الاستشهادات من الكلمة في الكلاسيكية
    اكتشف الأدب الذي لا شك فيه
    مصدر. لوريم إيبسوم يأتي من أقسام
    1.10.32 و 1.10.33 من "de Finibus Bonorum
    et Malorum "(أقصى الخير و
    الشر) بواسطة شيشرون ، مكتوب عام 45 قبل الميلاد. هذا الكتاب
    أطروحة في نظرية الأخلاق جدا
    شعبية خلال عصر النهضة. الأول
    سطر لوريم إيبسوم ، "Lorem ipsum dolor sit
    amet .. "، يأتي من سطر في القسم 1.10.32.
    الجزء القياسي المستخدم من لوريم إيبسوم
    منذ 1500s مستنسخة أدناه ل
    المهتمين. الأقسام 1.10.32 و
    1.10.33 من “de Finibus Bonorum et
    Malorum ”بواسطة Cicero مستنسخة أيضًا في
    شكلها الأصلي بالضبط ، يرافقه
    النسخ الإنجليزية من ترجمة عام 1914
    بواسطة H. Rackham.
    خلافا للاعتقاد الشائع ، فإن Lorem Ipsum هو
    ليس مجرد نص عشوائي. لها جذور في أ
    قطعة من الأدب اللاتيني الكلاسيكي من 45
    قبل الميلاد ، مما يجعلها أكثر من 2000 سنة. ريتشارد
    مكلينتوك ، أستاذ لاتيني في هامبدن';

    static $term_gr = '
    Entgegen der landläufigen Meinung ist Lorem Ipsum
    nicht einfach zufälliger Text. Es hat Wurzeln in a
    Stück klassische lateinische Literatur aus 45
    BC und ist damit über 2000 Jahre alt. Richard
    McClintock, ein Latein-Professor am Hampden Sydney College in Virginia, suchte einen von
    die dunkleren lateinischen Wörter consectetur,
    von einer Lorem-Ipsum-Passage, und gehen
    durch die Zitate des Wortes in der Klassik
    Literatur, entdeckte das Unzweifelhafte
    Quelle. Lorem Ipsum kommt aus Abschnitten
    1.10.32 und 1.10.33 von „de Finibus Bonorum“
    et Malorum“ (Die Extreme des Guten und
    Böse) von Cicero, geschrieben im Jahr 45 v. Dieses Buch ist
    eine Abhandlung über die Theorie der Ethik, sehr
    beliebt in der Renaissance. Der Erste
    Linie von Lorem Ipsum, „Lorem ipsum dolor sit
    amet..“, stammt aus einer Zeile in Abschnitt 1.10.32.
    Das Standardstück von Lorem Ipsum verwendet
    seit 1500 ist unten wiedergegeben für
    die Interessierten. Abschnitte 1.10.32 und
    1.10.33 aus „de Finibus Bonorum et
    Malorum“ von Cicero sind auch in . wiedergegeben
    ihre genaue Originalform, begleitet von
    Englische Versionen aus der Übersetzung von 1914
    von H. Rackham.
    Entgegen der landläufigen Meinung ist Lorem Ipsum
    nicht einfach zufälliger Text. Es hat Wurzeln in a
    Stück klassische lateinische Literatur aus 45
    BC und ist damit über 2000 Jahre alt. Richard
    McClintock, ein Latein-Professor in Hampden“;
    
    ';




    public function toArray()
    {
        $NewUserNews = News::inRandomOrder()->limit(5)->latest()->get();

        //  $user = User::with('owner.property')->where('id', $this->id)->first();
        $owners = User::find($this->id)->owner->property ?? null;
        $tenants = User::find($this->id)->tenant->property ?? null;
        // return $tenants = User::find($this->id)->tenant->rent()->property;
        if ($tenants) {
            return [
                'id' => $this->id,
                'code' => $this->code,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'email_verified_at' => $this->email_verified_at,
                'country' => $this->country,
                'city' => $this->city,
                'mobile_number' => $this->mobile_number,
                'image_url' => $this->image_path,
                'type' => $this->type,
                'status' => $this->status,
                'news' => $NewUserNews,
                'nationalty' => $this->nationalty,
                'id_number' => $this->id_number,
                'properties' => $tenants ?? [],
            ];
        } else {
            return [
                'id' => $this->id,
                'code' => $this->code,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'email_verified_at' => $this->email_verified_at,
                'country' => $this->country,
                'city' => $this->city,
                'mobile_number' => $this->mobile_number,
                'image_url' => $this->image_path,
                'type' => $this->type,
                'status' => $this->status,
                'news' => $NewUserNews,
                'nationalty' => $this->nationalty,
                'id_number' => $this->id_number,
                'properties' => $owners ?? [],
            ];
        }
    }
    public function moveIn()
    {
        $this->hasMany(MoveIn::class);
    }

    public function getImagePathAttribute($value)
    {
        if (!$this->image_url) {
            return asset('admin/assets/media/users/300_25.jpg');
        }
        if (stripos($this->image_url, 'http') ===  0) {
            return $this->image_url;
        }
        return asset('uploads/' . $this->image_url);
    }
}
