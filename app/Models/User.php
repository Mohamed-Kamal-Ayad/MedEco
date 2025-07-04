<?php

namespace App\Models;

use Parental\HasChildren;
use App\Http\Filters\Filterable;
use App\Http\Filters\UserFilter;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Support\Traits\Selectable;
use App\Models\Helpers\UserHelpers;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Resources\CustomerResource;
use App\Models\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Contracts\NotificationTarget;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class User extends Authenticatable implements HasMedia, NotificationTarget
{
    use HasFactory;
    use Notifiable;
    use UserHelpers;
    use InteractsWithMedia;
    use HasApiTokens;
    use PresentableTrait;
    use Filterable;
    use Selectable;
    use HasUploader;
    use Impersonate;
    use HasRoles;

    const PHARMACY_TYPE = 'pharmacy';

    const USER_TYPE = 'user';


    /**
     * The guard name of the user permissions.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',  // Include 'type' in fillable for mass assignment
        'remember_token',
        'national_id',
        "birthdate",
        "gender"
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
    ];

    /**
     * The presenter class name.
     *
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = UserFilter::class;

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */

    public function Pharmacy()
    {
        return $this->hasOne(Pharmacy::class);
    }

    // public function Branch()
    // {
    //     return $this->hasMany(Branch::class);
    // }

    public function dashboardProfile(): string
    {
        return '#';
    }

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }

    /**
     * Get the resource for customer type.
     *
     * @return \App\Http\Resources\CustomerResource
     */
    public function getResource()
    {
        return new CustomerResource($this);
    }

    /**
     * Get the access token currently associated with the user. Create a new.
     *
     * @param string|null $device
     * @return string
     */
    public function createTokenForDevice($device = null)
    {
        $device = $device ?: 'Unknown Device';

        $this->tokens()->where('name', $device)->delete();

        return $this->createToken($device)->plainTextToken;
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(70)
                    ->format('png');

                $this->addMediaConversion('small')
                    ->width(120)
                    ->format('png');

                $this->addMediaConversion('medium')
                    ->width(160)
                    ->format('png');

                $this->addMediaConversion('large')
                    ->width(320)
                    ->format('png');
            });
    }

    /**
     * Determine whither the user can impersonate another user.
     *
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    /**
     * Determine whither the user can be impersonated by the admin.
     *
     * @return bool
     */
    public function canBeImpersonated()
    {
        return $this->isSupervisor();
    }

    /**
     * Get the entity's notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(NotificationModel::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * The title of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationTitle(NotificationModel $notification): string
    {
        return $this->name;
    }

    /**
     * The body of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationBody(NotificationModel $notification): string
    {
        if ($notification->user->isCustomer()) {
            return trans('notifications.new-customer', [
                'user' => $this->name,
            ]);
        }

        return __('New user has been registered.');
    }

    /**
     * The image of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationImage(NotificationModel $notification): string
    {
        return $this->getAvatar();
    }

    /**
     * The data of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return mixed|void
     */
    public function getNotificationData(NotificationModel $notification)
    {
        return $this->getResource();
    }

    /**
     * The dashboard url of the notification.
     *
     * @param \App\Models\NotificationModel $notification
     * @return string
     */
    public function getNotificationDashboardUrl(NotificationModel $notification): string
    {
        $parameters = [
            $this,
            'notification_id' => $notification->id,
            'action' => 'delete',
        ];

        if ($this->isAdmin()) {
            return route('dashboard.admins.show', $parameters);
        }

        if ($this->isSupervisor()) {
            return route('dashboard.supervisors.show', $parameters);
        }

        return route('dashboard.customers.show', $parameters);
    }

    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getPointsAttribute()
    {
        $p = $this->orders->where('is_completed', 1)->sum(function ($order) {
            return $order->items->sum(function ($item) {
                return $item->quantity * $item->drug->points;
            });
        });
        $p = $p - $this->redeems->where('is_approved', 1)->sum('points');
        return $p;
    }
    public function redeems()
    {
        return $this->hasMany(Redeem::class);
    }

    /**
     * Get the prescriptions for the user.
     */
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}