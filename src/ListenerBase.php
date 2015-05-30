<?php
/**
 * Notifier
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @copyright 2015 MehrAlsNix (http://www.mehralsnix.de)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://github.com/MehrAlsNix/Notifier
 */

namespace MehrAlsNix\Notifier;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_BaseTestListener as BaseTestListener;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestSuite as TestSuite;

abstract class ListenerBase extends BaseTestListener
{
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->notify("Error", $e->getMessage());
        parent::addError($test, $e, $time);
    }

    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        $this->notify("Failure", $e->getMessage());
        parent::addFailure($test, $e, $time);
    }

    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->notify("Incomplete Test", $e->getMessage());
        parent::addIncompleteTest($test, $e, $time);
    }

    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->notify("Risky Test", $e->getMessage());
        parent::addRiskyTest($test, $e, $time);
    }

    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->notify("Skipped Test", $e->getMessage());
        parent::addSkippedTest($test, $e, $time);
    }

    abstract protected function notify($title, $message);

    /*
{
    $this->notifier->notify($title, $message);
    if (strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN') {
        exec(__DIR__ . "/../vendor/nels-o/toaster/toast/bin/Release/toast.exe -t \"{$title}}\" -m \"{$message}\"");
    } elseif ($this->execute('which terminal-notifier')) {
        $this->execute("terminal-notifier -title '{$title}' -message '{$message}' -sender com.apple.Terminal");
    } elseif ($this->execute('which notify-send')) {
        $this->execute("notify-send -t 2000 '{$title}' '$message'");
    } else {
        echo PHP_EOL;
        echo "{$title} - {$message}";
        echo PHP_EOL;
        echo PHP_EOL;
    }
    }
    */

    protected function execute($command)
    {
        $status = null;
        $result = [];
        exec($command, $result, $status);
        return !$status ? $result : null;
    }
}

