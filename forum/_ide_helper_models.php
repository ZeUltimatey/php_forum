<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cache newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cache newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cache query()
 */
	class Cache extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $key
 * @property string $owner
 * @property int $expiration
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CacheLock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CacheLock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CacheLock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CacheLock whereExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CacheLock whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CacheLock whereOwner($value)
 */
	class CacheLock extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $uuid
 * @property string $connection
 * @property string $queue
 * @property string $payload
 * @property string $exception
 * @property string $failed_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob whereConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob whereException($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob whereFailedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FailedJob whereUuid($value)
 */
	class FailedJob extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $queue
 * @property string $payload
 * @property int $attempts
 * @property int|null $reserved_at
 * @property int $available_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereAvailableAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereQueue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Job whereReservedAt($value)
 */
	class Job extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $total_jobs
 * @property int $pending_jobs
 * @property int $failed_jobs
 * @property string $failed_job_ids
 * @property string|null $options
 * @property int|null $cancelled_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property int|null $finished_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereCancelledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereFailedJobIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereFailedJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch wherePendingJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobBatch whereTotalJobs($value)
 */
	class JobBatch extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Migration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Migration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Migration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Migration whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Migration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Migration whereMigration($value)
 */
	class Migration extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PasswordResetToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PasswordResetToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PasswordResetToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PasswordResetToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PasswordResetToken whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PasswordResetToken whereToken($value)
 */
	class PasswordResetToken extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Thread|null $thread
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Post query()
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Session whereUserId($value)
 */
	class Session extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Thread whereUserId($value)
 */
	class Thread extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

