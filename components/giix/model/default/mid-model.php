<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 8/23/16 4:02 PM
 */

echo "<?php\n";
?>

namespace <?= $generator->nsCommonBase ?>;

use Yii;

if (class_exists("\\common\\models\\base\\<?= 'Base' . $className ?>")) {
    class <?= 'Mid' . $className ?> extends \common\models\base\<?= 'Base' . $className ?>
    {

    }
} else {
    class <?= 'Mid' . $className ?> extends <?= 'Base' . $className ?>
    {

    }
}
