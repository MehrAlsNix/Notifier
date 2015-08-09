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

/**
 * Class Notify
 * @package MehrAlsNix\Notifier
 */
class Notify
{
    /** @var Notification $instance */
    private static $instance;

    /**
     * Get instance.
     *
     * @return Notification
     *
     * @throws \RuntimeException
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof Notification) {
            self::$instance = self::fetch();
        }

        return self::$instance;
    }

    /**
     * Fetches an instance by checking for ability.
     *
     * @return Commands\Linux|Commands\Mac|Commands\Windows
     *
     * @throws \RuntimeException
     */
    protected static function fetch()
    {
        if ((new Commands\Windows())->isAvailable()) {
            $instance = new Commands\Windows();
        } elseif((new Commands\Linux())->isAvailable()) {
            $instance = new Commands\Linux();
        } elseif((new Commands\Mac())->isAvailable()) {
            $instance = new Commands\Mac();
        } else {
            $instance = 'No valid desktop notifier found.';
        }

        if (is_string($instance)) {
            throw new \RuntimeException($instance);
        }

        return $instance;
    }
}
