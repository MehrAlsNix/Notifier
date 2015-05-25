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

use MehrAlsNix\Notifier\Listener;
use PHPUnit_Framework_TestCase as TestCase;

class ListenerTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        assumePhpVersion('5.4', 'PHP version lower than 5.4');
    }

    /**
     * @test
     */
    public function instantiation()
    {
        $this->assertInstanceOf('MehrAlsNix\Notifier\Listener', new Listener());
    }
}
