<?php

namespace App\Models;

use App\Enums\ScheduleStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'classroom_type',
        'classroom_location',
        'start_date',
        'end_date',
        'start_time',
        'days_of_week',
        'max_students',
        'status',
        'course_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_at' => 'datetime: H:i',
        'status' => ScheduleStatusEnum::class,
    ];

    public function getDaysOfWeekAttribute($value)
    {
        return json_decode($value);
    }

    public function getStartDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getEndDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
