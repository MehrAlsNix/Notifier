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
    /**
     * @dataProvider getExceptionAsserted
     */
    public function testNotifyIsCalledByAddError($method, $title, $content)
    {
        $partialMock = $this->getMockBuilder('MehrAlsNix\Notifier\ListenerBase')
            ->setMethods(['notify'])
            ->getMockForAbstractClass();

        $partialMock->expects($this->once())
            ->method('notify')
            ->with($title, $content);

        $mockTest = $this->getMockObjectGenerator()
            ->getMock('PHPUnit_Framework_Test');

        $partialMock->$method($mockTest, new \Exception($content), time());
    }

    public function testNotifyIsCalledByAddFailure()
    {
        $partialMock = $this->getMockBuilder('MehrAlsNix\Notifier\ListenerBase')
            ->setMethods(['notify'])
            ->getMockForAbstractClass();

        $title = 'Failure';
        $content = '';
        $partialMock->expects($this->once())
            ->method('notify')
            ->with($title, $content);

        $mockTest = $this->getMockObjectGenerator()
            ->getMock('PHPUnit_Framework_Test');

        $partialMock->addFailure($mockTest, new AssertionFailedError($content), time());
    }

    /**
     * @return array
     */
    public function getExceptionAsserted()
    {
        return [
            ['addError', 'Error', 'error message'],
            ['addRiskyTest', 'Risky Test', 'risky Test !'],
            ['addIncompleteTest', 'Incomplete Test', 'incomplete Test !'],
            ['addSkippedTest', 'Skipped Test', 'skipped Test !']
        ];
    }
}
