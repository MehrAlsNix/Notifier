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

namespace MehrAlsNix\Notifier\Tests;

use MehrAlsNix\Notifier\Notify;
use PHPUnit_Framework_AssertionFailedError as AssertionFailedError;

/**
 * Class NotificationTest
 * @package MehrAlsNix\Notifier\Tests
 */
class NotificationTest extends \PHPUnit_Framework_TestCase
{
    public function testNotifyIsCalledByAddFailure()
    {
        $partialMock = $this->getMockBuilder('MehrAlsNix\Notifier\Notification')
            ->setMethods(array('notify'))
            ->getMockForAbstractClass();

        $title = 'Failure';
        $content = '';
        $partialMock->expects($this->once())
            ->method('notify')
            ->with($title, $content);

        $fE = new AssertionFailedError($content);
        $partialMock->sendMessage('Failure', $fE->getMessage());
    }

    public function testNotify()
    {
        $this->assertInstanceOf(
            'MehrAlsNix\Notifier\Notification',
            Notify::getInstance()
                ->sendMessage('HALLO', 'TEST')
        );
    }

    public function testInstantiationWithParam()
    {
        $this->assertInstanceOf(
            'MehrAlsNix\Notifier\Notification',
            Notify::getInstance('\MehrAlsNix\Notifier\Commands\Windows')
                ->sendMessage('HALLO', 'TEST')
        );
    }

    /**
     * @expectedException \MehrAlsNix\Notifier\Exception
     */
    public function testInstantiationMessageBasedWithoutMsg()
    {
        $this->assertInstanceOf(
            'MehrAlsNix\Notifier\Notification',
            Notify::getInstance()
                ->setTitle('HALLO')
                ->send()
        );
    }

    public function testInstantiationMessageBased()
    {
        $this->assertInstanceOf(
            'MehrAlsNix\Notifier\Notification',
            Notify::getInstance()
                ->setTitle('HALLO')
                ->setMessage('TEST')
                ->send()
        );
    }

    public function testInstantiationWithIcon()
    {
        $this->assertInstanceOf(
            'MehrAlsNix\Notifier\Notification',
            Notify::getInstance()
                ->setTitle('HALLO')
                ->setMessage('TEST')
                ->setIcon(__DIR__ . '/../resources/levels/128x128/info.png')
                ->send()
        );
    }
}
