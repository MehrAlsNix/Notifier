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

use PHPUnit_Framework_AssertionFailedError as AssertionFailedError;

/**
 * Class ListenerBaseTest
 * @package MehrAlsNix\Notifier\Tests
 */
class ListenerBaseTest extends \PHPUnit_Framework_TestCase
{
    public function testNotifyIsCalledByAddFailure()
    {
        $partialMock = $this->getMockBuilder('MehrAlsNix\Notifier\NotificationBase')
            ->setMethods(['notify'])
            ->getMockForAbstractClass();

        $title = 'Failure';
        $content = '';
        $partialMock->expects($this->once())
            ->method('notify')
            ->with($title, $content);

        $mockTest = $this->getMockObjectGenerator()
            ->getMock('PHPUnit_Framework_Test');

        $fE = new AssertionFailedError($content);
        $partialMock->addMessage('Failure', $fE->getMessage());
    }
}
