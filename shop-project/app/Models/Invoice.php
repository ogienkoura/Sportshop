<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

/**
 * @property int $id
 * @property string $hash
 * @property float $amount
 * @property int $user_id
 * @property string $status
 * @property string $created_at
 *
 */
class Invoice extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_PAID = 'paid';
    public const STATUS_PENDING = 'pending';
    public const STATUS_DECLINED = 'declined';

    public $table = 'invoices';

    public $fillable = [
        'hash', 'amount', 'user_id', 'status'
    ];


}
