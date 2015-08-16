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

namespace MehrAlsNix\Notifier\Commands;
use MehrAlsNix\Notifier\Notification;

/**
 * Class Windows.
 *
 * @package MehrAlsNix\Notifier
 */
class Windows extends Notification
{
    /**
     * Notify with `toast.exe`.
     *
     * @param string $title
     * @param string $message
     * @param string $icon    optional
     *
     * @return void
     */
    protected function notify($title, $message, $icon = null)
    {
        $app = '/../../vendor/nels-o/toaster/toast/bin/Release/toast.exe';
        if (!file_exists($app)) {
            $app = '/../../../../nels-o/toaster/toast/bin/Release/toast.exe';
        }

        $icon = is_string($icon) ? " -p \"$icon\"" : '';
        $this->execute(__DIR__ . "$app -t \"{$title}\" -m \"{$message}\"$icon");
    }

    /**
     * @inheritdoc
     *
     * @return bool
     */
    public function isAvailable()
    {
        return strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN';
    }
}
